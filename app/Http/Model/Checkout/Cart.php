<?php

namespace App\Http\Model\Checkout;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\Catalog\ProductVariationValue;
use App\Http\Model\Catalog\Product;
use App\Http\Model\Catalog\ProductVariation;
use App\Http\Model\Catalog\Variation;
use App\Http\Model\Catalog\ProductSpecial;

class Cart extends Model
{
    //
    protected $table = 'cart';
    protected $primaryKey = 'cart_id';
    protected $connection = 'mysql';

    public function detail($cartDetail){
        $cart = array();
        $total = 0;
        foreach (json_decode($cartDetail->cart) as $key => $v) {
                $product = Product::where('product_id', $v->product_id)->where('status', 1)->first();
                $productSpecial = ProductSpecial::where('product_id', $v->product_id)->first();
                if ($productSpecial) {
                    $price = $productSpecial->price;
                } else {
                    $price = $product->price;
                }
                /*            foreach ($v->variation as $variation => $value) {
                                $productVariationValue = ProductVariationValue::where('variation_id', $variation)->where('value_id', $value)->where('product_id', $v->product_id)->first();
                                print_r($productVariationValue);
                                exit();
                                if ($productVariationValue->count()) {
                                    $productVariationValue = $productVariationValue->first();
                                    if($productVariationValue->price_prefix == '+') {
                                        $price = $price + $productVariationValue->price;
                                    } elseif ($productVariationValue->price_prefix == '-'){
                                        $price = $price - $productVariationValue->price;
                                    }

                                }
                            }*/
                $cart[$key]= array(
                    'name' => $product->name,
                    'url' => $product->seo_url,
                    'id' => $product->product_id,
                    'quantity' => $v->quantity,
                    'item_price' => $price,
                    'item_total' => $price * $v->quantity,
                    'image' => empty($product->image) ? asset('images.png') : asset('catalog/'.$product->image),
                    'description' => $product->short_description,
                    'variation' => $v->variation,
                );

            $total = $total + ($price * $v->quantity);


          }



          $cartDe = Cart::find($cartDetail->cart_id);
          $cartDe->sub_total =  $total;
          $cartDe->grant_total =  $cartDe->sub_total  + $cartDe->shipping;
          $cartDe->save();



          return $cart;


    }
}
