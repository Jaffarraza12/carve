<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Model\Catalog\Category;
use App\Http\Model\Catalog\Product;
use App\Http\Controllers\Catalog\CategoryController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::get('/','Common\HomeController@index');
Route::get('cart','Checkout\CartController@index');
Route::post('cart/add','Checkout\CartController@add');
Route::post('cart/remove','Checkout\CartController@remove');


Route::get('checkout','Checkout\CheckoutController@index');
Route::get('checkout/cities','Checkout\CheckoutController@cities');

Route::post('checkout/validate','Checkout\CheckoutController@validateOrder');
Route::post('cart/shipping','Checkout\CartController@addShipping');
Route::post('cart/update','Checkout\CartController@update');

Route::get('order-{id}','Checkout\OrderController@success');


//Route::get('{slug}', ['uses' => 'Catalog\CategoryController@get']);

Route::get('/{slug}', function($slug) {
    $product = Product::where('seo_url',$slug)->where('status',1);
    if($product->count()){
        return App::call('App\Http\Controllers\Catalog\ProductController@get' , ['product' => $product->first()]);
    }

    $category = Category::where('seo_url',$slug)->where('status',1);
    if($category->count()){
        return App::call('App\Http\Controllers\Catalog\CategoryController@get' , ['category' => $category->first()]);
    } else {
        throw new NotFoundHttpException;
    }
});