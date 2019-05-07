<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Model\Checkout\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //

    public function success($id)
    {
        $order = Order::where('order_id',$id)->first();

        return view ('checkout.success',compact('order'));




    }
}
