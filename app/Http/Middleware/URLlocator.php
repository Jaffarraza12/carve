<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use App\Http\Model\Catalog\Category;
use App\Http\Controllers\Catalog\CategoryController;
use App\Http\Model\Catalog\Product;
use Illuminate\View;


class URLlocator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $URL = basename(url()->current());
        $category = Category::where('seo_url',$URL)->where('status',1);
        if($category->count()){
            $category  = $category->first();
            $classArgs = [
                'category'    => $category,
            ];
            return App::make(CategoryController::class,$classArgs)->view();
         }

            return $next($request);
    }
}
