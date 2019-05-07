<?php

namespace App\Http\Model\Checkout;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    protected $connection = 'mysql';
    public $timestamps = false;
}
