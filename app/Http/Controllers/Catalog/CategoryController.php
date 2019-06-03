<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Model\Catalog\Product;
use App\Http\Model\Catalog\ProductSpecial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View;
use App\Http\Model\Catalog\CategoryProduct;
class CategoryController extends Controller
{


    public function get($category){

       $data = array();
       $canonical = url()->current();
       $products = array();
       $CategoryProduct = Product::join('product_to_category','product_to_category.product_id','=','product.product_id')
           ->where('product_to_category.category_id',$category->category_id)->where('product.status',1)->distinct('product.product_id')->get();
       foreach ($CategoryProduct as $product) {
           $productSpecial = ProductSpecial::where('product_id', $product->product_id)->first();
           if (!empty($product->price))
           {
               $products[] = array(
                   'name' => empty($product->name) ? '' : $product->name,
                   'seo_url' => empty($product->seo_url) ? '#' : $product->seo_url,
                   'price' => $product->price,
                   'image' =>  empty($product->image) ? asset('images.png') : asset('catalog/'.$product->image),
                   'special' => $productSpecial,
               );
            }
       }


       return view('catalog.category',compact('category','canonical','products'));

    }




}
