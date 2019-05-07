<?php

namespace App\Http\Model\Checkout;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    //
    protected $table = 'order_product';
    protected $primaryKey = 'order_product_id';
    protected $connection = 'mysql';
    public $timestamps = false;
}
