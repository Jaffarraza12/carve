<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Model\Catalog\Category;
use App\Http\Model\Checkout\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $categories = Category::where('top', 1)->where('status', 1)->OrderBy('sort_order')->get();
        $cart = new Cart();
        $quantity = $cart->CartQuantity();

            View::share('categories', $categories);
            View::share('cart_quantity', $quantity);

    }
}

