<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Model\Catalog\ProductImage;
use App\Http\Model\Catalog\ProductVariation;
use App\Http\Model\Catalog\ProductSpecial;
use App\Http\Model\Catalog\ProductVariationValue;
use App\Http\Model\Catalog\Variation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //
    public function get($product){
        $data = array();
        $canonical = url()->current();
        $pImages = ProductImage::where('product_id',$product->product_id)->get();
        $productImages = array();
        $productImages[0] = empty($product->image) ? asset('images.png') : asset('catalog/'.$product->image);
        $i =1;
        foreach ($pImages as $image){
            $productImages[$i] = empty($image->image) ? asset('images.png') : asset('catalog/'.$image->image);
            ++$i;
        }
        $variations = Variation::join('variation_value', 'variation_value.variation_id', '=', 'variation_value.variation_id')->get();
        $productVariations = ProductVariation::join('variation','variation.variation_id','=','product_variation.variation_id')
            ->where('product_id',$product->product_id)
            ->get();
        $productVariationValues = array();
       foreach ($productVariations as $variation){
           $productVariationValues[$variation->variation_id] = ProductVariationValue::join('variation_value','variation_value.value_id','=','product_variation_value.value_id')
               ->where('product_variation_value.variation_id',$variation->variation_id)
               ->where('product_variation_value.product_id',$product->product_id)
               ->get();

       }

        $productSpecial = ProductSpecial::where('product_id',$product->product_id)->first();


        return view('catalog.product',compact('canonical','product','productImages','productVariations','productVariationValues','productSpecial'));

    }

}
