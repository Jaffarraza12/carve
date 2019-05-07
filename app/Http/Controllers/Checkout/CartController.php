<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Model\Catalog\ProductVariationValue;
use App\Http\Model\Catalog\Product;
use App\Http\model\localization\Zone;
use App\Http\Model\Catalog\ProductVariation;
use App\Http\Model\Catalog\Variation;
use App\Http\Model\Catalog\ProductSpecial;
use App\Http\Model\Catalog\VariationValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Checkout\Cart;

use App\Http\Model\Extension\Shippment\area;

class CartController extends Controller
{
    //
    function index(Request $request){
        $cart_id = (isset($_COOKIE['cart_id'])? $_COOKIE['cart_id'] : 0 );
        $country_id = 162;
        if($cart_id){
        $cartDetail = Cart::where('key',$cart_id);

        $zones = Zone::where('country_id',$country_id)->get();
            if($cartDetail->count()) {
                $cartDetail = $cartDetail->first();
                if(empty( json_decode($cartDetail->cart, true) )){
                    $cart_message = 'Your Cart is Empty';
                } else {
                $cart  = array();
                $ct = new Cart();
                $cart = $ct->detail($cartDetail);
                }


            } else {
                $cart_message = 'Your Cart is Empty';
            }
        } else {
            $cart_message = 'Your Cart is Empty';
        }



        return view('checkout.cart',compact('cart','cart_message','cartDetail','zones'));
    }

    function add(Request $request){

        $item = array() ;
        $json = array() ;
        $json['error'] = '' ;
        $item['product_id'] = $request->input('product_id');
        $product = Product::where('product_id',$item['product_id'])->where('status',1)->first();
        $productSpecial = ProductSpecial::where('product_id',$item['product_id'])->first();
        $price = 0 ;
        if($productSpecial ){
            $price = $productSpecial->price;
        } else{
            $price = $product->price;
        }

        if($product->quantity >= $request->input('quantity')  ) {

            foreach ($request->option as $variation => $value) {
                $productVariation = ProductVariation::where('variation_id', $variation)->where('product_id', $item['product_id'])->first();
                if (empty($value) && $productVariation->required == 1) {
                    $json['error'] = " Select the required variants. ";
                    echo json_encode($json);
                    exit();
                }
                //check appropiate parameter
                $productVariationValue = ProductVariationValue::where('variation_id', $variation)->where('value_id', $value)->where('product_id', $item['product_id']);
                if ($productVariationValue->count()) {

                    $productVariationValue = $productVariationValue->first();
                    if ($productVariationValue->quantity >= $request->input('quantity') || $productVariationValue->subtract == 0) {
                        $variationValue = VariationValue::where('value_id', $value)->first();
                        $variate = Variation::where('variation_id', $variation)->first();
                        if($productVariationValue->price_prefix == '+') {
                            $price = $price + $productVariationValue->price;
                        } elseif ($productVariationValue->price_prefix == '-'){
                            $price = $price - $productVariationValue->price;
                        }
                        $item['variation'][$variation] = array(
                            'id' => $variationValue->value_id,
                            'name' => $variate->name,
                            'type' => $variate->type,
                            'value_name' => $variationValue->name,
                            'image' => $productVariationValue->image,
                            'prefix' => $productVariationValue->price_prefix,
                            'price' => $productVariationValue->price,
                        );
                    } else {
                        $json['error'] = " Variation Out Of Stock";
                    }

                } else {
                    $json['error'] = "Invalid Varitaion";
                }
            }
        } else {
            $json['error'] = " Product is Out Of Stock";
        }

        $item['item_price'] = $price;
        $item['price'] = $price * $request->input('quantity');
        $item['quantity'] = $request->input('quantity');
        if($json['error'] != ''){
            echo json_encode($item);
        } else {
            $this->save($item);
        }
    }
    function save($item){
        //unset($_COOKIE['cart_id']);
       $cart_id = (isset($_COOKIE['cart_id'])? $_COOKIE['cart_id'] : 0 );
       $total = 0;

        if($cart_id) {
            $cartDetail = Cart::where('key', $cart_id);
            if($cartDetail->count()) {
                $cartDetail = $cartDetail->first();
                $oldcart = json_decode($cartDetail->cart, true);
                $matches =  array();
                $match = false;
                $match_index = '';
                if(!empty( json_decode($cartDetail->cart, true) )) {
                    foreach ($oldcart as $kc => $oc) {
                        if ($oc['product_id'] == $item['product_id']) {
                            $i = 0;
                            foreach ($oc['variation'] as $variation => $value) {
                                if (array_key_exists($variation, $item['variation']) && $item['variation'][$variation]['id'] == $value['id']) {
                                    $matches[$kc][$i] = 1;

                                } else {
                                    $matches[$kc][$i] = 0;
                                }
                                $i++;
                            }
                        } else {
                            continue;

                        }
                    }
                    foreach ($matches as $k => $m) {
                        if (!in_array(0, $m, true)) {
                            $match_index = $k;
                        }
                    }

                    if (gettype($match_index) == 'integer') {
                        $cart = Cart::where('key', $cart_id)->first();
                        $cart = Cart::find($cart->cart_id);
                        $cart->customer_id = 0;
                        $oldcart[$match_index]['quantity'] = $oldcart[$match_index]['quantity'] + $item['quantity'];
                        $oldcart[$match_index]['price'] = $oldcart[$match_index]['quantity'] * $item['price'];
                        $cart->cart = json_encode($oldcart);
                        $cart->sub_total = $oldcart[$match_index]['price'];
                        $cart->grant_total = $cart->sub_total + $cart->shipping;
                        $cart->save();

                    } else {
                        $cart = Cart::where('key', $cart_id)->first();
                        $cart = Cart::find($cart->cart_id);
                        $cartArray = array();
                        $cartArray[] = $item;
                        $newArray = array_merge($oldcart, $cartArray);
                        $cart->cart = json_encode($newArray);
                        $cart->sub_total = $cart->sub_total + $item['price'];
                        $cart->grant_total = $cart->sub_total + $cart->shipping;
                        $cart->save();


                    }
                } else {
                     $cartArray = array();
                    $cartArray[] =  $item;
                    $cart = Cart::where('key', $cart_id)->first();
                    $cart = Cart::find($cart->cart_id);
                    $cart->customer_id = 0;
                    $cart->key= $cart_id;
                    $cart->cart = json_encode($cartArray);
                    $cart->sub_total =  $item['price'];
                    $cart->grant_total =  $cart->grant_total + $cart->sub_total;
                    $cart->save();

                }
            }
        } else {

            //create key
            $cookie_name = "cart_id";
            $newKey = time();
            setcookie($cookie_name, $newKey, time() + (86400 * 30 * 30), "/"); // 86400 = 1 day
            $cartArray = array();
            $cartArray[] =  $item;
            $cart = new Cart();
            $cart->customer_id = 0;
            $cart->key= $newKey;
            $cart->name = '';
            $cart->email = '';
            $cart->cart = json_encode($cartArray);
            $cart->sub_total =  $item['price'];
            $cart->grant_total =  $cart->grant_total + $cart->sub_total;
            $cart->save();
        }
        $json['success'] = true;
        echo json_encode($json)
;



    }

    function  addShipping(Request $request){
        $cart_id = (isset($_COOKIE['cart_id'])? $_COOKIE['cart_id'] : 0 );
        $json = array();
        if($request->city == 0 || $request->state == 0){
            $json['error'] = true;
        } else {
            $area = new area();
            $cost = $area->getCost( $request->state,$request->city);
            $cartDetail = Cart::where('key',$cart_id)->first();
            $cart = Cart::find($cartDetail->cart_id);
            $cart->shipping = $cost->rates  ;
            $cart->grant_total = $cart->sub_total +  $cost->rates;
            $cart->save();
            $json['success'] = true;
            $json['grant_total'] = $cart->grant_total.' RS' ;
            if($cost->rates != 0 ) {
                $json['shipping'] = $cart->shipping .' RS';
            } else {
                $json['shipping'] = 'FREE ';
            }


        }
        echo json_encode($json);

    }

    function update(Request $request){
        $cart_id = (isset($_COOKIE['cart_id'])? $_COOKIE['cart_id'] : 0);
        $cartDetail = Cart::where('key',$cart_id)->first();
        $cart = Cart::find($cartDetail->cart_id);
        $oldcart = json_decode($cartDetail->cart, true);

        $subTotal = $cartDetail->sub_total - $oldcart[$request->key]['price'];
        $grantTotal = $cartDetail->grant_total - $oldcart[$request->key]['price'];

        $cart->customer_id = 0;
        $oldcart[$request->key]['quantity'] =  $request->quantity;
        $oldcart[$request->key]['price'] = $request->quantity * $oldcart[$request->key]['item_price'];
        $cart->cart = json_encode($oldcart);
        $cart->sub_total =  $subTotal +  $oldcart[$request->key]['price'] ;
        $cart->grant_total =  $cart->sub_total + $cart->shipping;

        $cart->save();
        $json['done'] = true;
        echo json_encode($json);


    }
    function  remove(Request $request){
        $cart_id = (isset($_COOKIE['cart_id'])? $_COOKIE['cart_id'] : 0 );

        if($cart_id ) {
            $cartDetail = Cart::where('key',$cart_id);
            if ($cartDetail->count()) {
                $cartDetail = $cartDetail->first();
                $oldcart = json_decode($cartDetail->cart, true);
                $subTotal = $cartDetail->sub_total - $oldcart[$request->key]['price'];
                unset($oldcart[$request->key]);
                $cartDetail = Cart::find($cartDetail->cart_id);
                $cartDetail->cart = json_encode($oldcart);
                $total = 0;
                foreach($oldcart as $key => $value ){
                    $total = $total + ($value['price'] * $value['quantity']);
                }
                $cartDetail->sub_total = $subTotal;
                $cartDetail->grant_total = $subTotal + $cartDetail->shipping;
                $cartDetail->save();
                $json['done'] = true;
                echo json_encode($json);



            }
        }

    }



}
