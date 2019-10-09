<?php

namespace App\Http\Controllers\Common;

use App\Http\Model\Catalog\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Catalog\Category;

class HomeController extends Controller
{
    //
    function index(){
        $homeCategories = Category::where('status',1)->OrderBy('sort_order','desc')->limit(2)->get();




        return view('common.home',compact('homeCategories'));
    }
}
