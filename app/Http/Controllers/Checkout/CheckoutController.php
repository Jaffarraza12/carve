<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\model\localization\Zone;
use App\Http\model\localization\ZoneCity;
use App\Http\Model\Checkout\Cart;
use App\Http\Model\Checkout\Order;
use App\Http\Model\Checkout\OrderProduct;
use App\Http\Model\Checkout\OrderVariation;
use App\Http\Model\Checkout\OrderNotes;
use App\Http\Model\Setting;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;


class CheckoutController extends Controller
{
    //




    public function index(){
        $country_id = 162 ;
        $cart_id = (isset($_COOKIE['cart_id'])? $_COOKIE['cart_id'] : 0 );
        if(!$cart_id ){
             return redirect('cart');
         }
        $zones = Zone::where('country_id',$country_id)->get();
        $cartDetail = Cart::where('key',$cart_id);
        if($cartDetail->count() == 0 ){
            return redirect('cart');
        }

        $cartDetail = $cartDetail->first();
        if(empty( json_decode($cartDetail->cart, true) )){
            return redirect('cart');
        } else {
            $cart  = array();
            $ct = new Cart();
            $cart = $ct->detail($cartDetail);
        }

        $quantity = 0 ;
        foreach($cart as $product){
            $quantity = $quantity + $product['quantity'];
        }

        return view('checkout.checkout',compact('zones','quantity','cart','cartDetail'));
    }


    public function cities(Request $request){
        $zoneCities = ZoneCity::where('zone_id',$request->id)->get();

        echo json_encode($zoneCities);
    }


    public function validateOrder(Request $request){
        $json = array();
        $validate = true;
        if(strlen($request->fullName) <= 2 ) {
            $json['error']['fullName'] = 'Full Name Should not be empty';
            $validate = false;
        }
        if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$request->fullName) && !$request->email ) {
            $json['error']['email'] = 'Email Address Should Be in Correct';
            $validate = false;
        }

        if(strlen($request->address) <= 3 ) {
            $json['error']['address'] = 'Address Should not be empty';
            $validate = false;
        }

        if($request->state == 0 ) {
            $json['error']['state'] = 'State Should be Select';
            $validate = false;
        }

        if($request->country == 0 ) {
            $json['error']['country'] = 'Country Should be Selected';
            $validate = false;
        }
        if($request->city == 0 ) {
            $json['error']['city'] = 'City Should be Selected';
            $validate = false;
        }

        if($validate){
            $cart_id = (isset($_COOKIE['cart_id'])? $_COOKIE['cart_id'] : 0 );
            $cartDetail = Cart::where('key',$cart_id)->first();
            $ct = new Cart();
            $request->cart = $ct->detail($cartDetail );
            $quantity= 0;
            foreach ($request->cart as $product){
                $quantity = $quantity+ $product['quantity'];
            }
            $request->quantity = $quantity;
            $request->grant_total = $cartDetail->grant_total;
            $request->sub_total = $cartDetail->sub_total;
            $request->shipping = $cartDetail->shipping;
            //check payment method exit
            $payment =  \App::make("App\Http\Model\Extension\Payment\\".$request->payment);
            $pay = $payment->doPayment($request);

            if($pay){
                $request->status = $pay['status'];
                $this->saveOrder($request);

            }
            
         } else {
            echo json_encode($json);
        }
    }

    public function saveOrder($request){
        $congig = array();

        $json = array();
        $setting = Setting::where('key','site_name')->first();
        $congig['site_name'] = $setting->value;
        $setting = Setting::where('key','site_url')->first();
        $congig['site_url'] = $setting->value;
        $setting = Setting::where('key','default_store')->first();
        $congig['default_store'] = $setting->value;

        $order = new Order();
        $order->invoice_prefix = 'INV_'.date('Y');
        $order->status = $request->status ;
        $order->name = $request->fullName;
        $order->store_name = $congig['site_name'];
        $order->store_url = $congig['site_url'];
        $order->store_id = $congig['default_store'];
        $order->email = $request->email;
        $order->phone = $request->phone;
        //payment
        $order->payment_name = $request->fullName;
        $order->payment_company = $request->company;
        $order->payment_address = $request->address;
        $order->payment_city = $request->city;
        $order->payment_country_id = $request->country;
        $order->payment_zone = $request->state;
        $order->payment_method = $request->payment;
        //shippment
        $order->shipping_name = $request->fullName;
        $order->shipping_company = $request->company;
        $order->shipping_address = $request->address;
        $order->shipping_city = $request->city;
        $order->shipping_country_id = $request->country;
        $order->shipping_zone = $request->state;
        $order->shipping_method = 'area';
        $order->quantity =$request->quantity;
        $order->grant_total = $request->grant_total;
        $order->sub_total = $request->sub_total;
        $order->shipping = $request->shipping;
        $order->affiliate_id = 0;
        $order->commission = 0;
        $order->tracking = 0;
        $order->currency_id = 0;
        $order->cart_id = (isset($_COOKIE['cart_id'])? $_COOKIE['cart_id'] : 0 );;
        $order->ip = $_SERVER['REMOTE_ADDR'];
        $order->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $order->save();
        Response::json(array('success' => true, 'last_insert_id' => $order->order_id), 200);
        foreach ($request->cart as $product ){
            $orderProduct = new OrderProduct;
            $orderProduct->order_id = $order->order_id;
            $orderProduct->product_id = $product['id'];
            $orderProduct->name= $product['name'];
            $orderProduct->price= $product['item_price'];
            $orderProduct->total= $product['item_total'];
            $orderProduct->quantity= $product['quantity'];
            $orderProduct->tax= 0;
            $orderProduct->save();
            Response::json(array('success' => true, 'last_insert_id' => $orderProduct->order_product_id), 200);
            foreach($product['variation'] as $key => $variation){
                $orderVariation = new OrderVariation;
                $orderVariation->order_id =$order->order_id;
                $orderVariation->order_product_id =$orderProduct->order_product_id;
                $orderVariation->product_variation_id = $key ;
                $orderVariation->product_variation_value_id = $variation->id     ;
                $orderVariation->name = $variation->name ;
                $orderVariation->value = $variation->value_name ;
                //$orderVariation->type = $variation->type;
                $orderVariation->save();
            }



            if($request->comment){
                $orderComment = new OrderNotes();
                $orderComment->order_id = $order->order_id;
                $orderComment->notes = $request->comment;
                $orderComment->save();
            }
        }

        //remove

        $order = Order::where('order_id',$order->order_id)->first();
        $zone = Zone::where('zone_id',$order->payment_zone)->first();
        $ZoneCity = ZoneCity::where('zone_city_id',$order->payment_city)->first();
        /*Mail::send('email.order-confirmation', ['order' => $order,'zoneCity' => $ZoneCity,'zone' => $zone], function ($m) use ($order ) {
            $m->from('support@carve.pk', 'CARVE SHOP');
            $m->cc('asimkhaliq@gmail.com', 'ASIM KHALIQ');
            $m->cc('jaffaraza@gmail.com', 'Jaffar Raza');
            $m->to($order->email, $order->carve)->subject('CARVE : ORDER CONFIRMATION EMAIL!');
        });*/

        /*$cart = array();
        $cart_id = (isset($_COOKIE['cart_id'])? $_COOKIE['cart_id'] : 0 );;
        $cartDetail = Cart::where('key',$cart_id)->first();
        $cartDetail = Cart::find($cartDetail->cart_id)  ;
        $cartDetail->cart = json_encode($cart);
        $cartDetail->shipping = 0;
        $cartDetail->sub_total= 0;
        $cartDetail->grant_total= 0;
        $cartDetail->save();*/
        $cookie_name = "cart_id";
        $newKey = time();
        setcookie($cookie_name, $newKey, time() + (86400 * 30 * 30), "/");
        $cart = new Cart();
        $cart->key = $newKey;
        $cart->save();


        $json['success'] = 'Order Has Been Saved!';
        $json['redirect'] = 'order-'.$order->order_id;
        echo json_encode($json);
    }
}
