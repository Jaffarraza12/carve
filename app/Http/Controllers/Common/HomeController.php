<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Catalog\Category;

class HomeController extends Controller
{
    //
    function index(){
        $homeCategories = Category::where('status',1)->OrderBy('sort_order','desc')->get();

        return view('common.home',compact('homeCategories'));
    }
}
