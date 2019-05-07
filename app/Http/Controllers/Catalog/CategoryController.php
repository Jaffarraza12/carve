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
       $CategoryProduct = CategoryProduct::where('category_id',$category->category_id)->distinct('product_id')->get();
       foreach ($CategoryProduct as $rec){
           $product = Product::where('product_id',$rec->product_id)->first();
           $productSpecial = ProductSpecial::where('product_id',$rec->product_id)->first();

           $products[] = array(
                'name' => $product->name,
                'seo_url' => $product->seo_url,
                'price' => $product->price,
                'image' => $product->image,
                'special' => $productSpecial,
            );
       }


       return view('catalog.category',compact('category','canonical','products'));

    }




}
