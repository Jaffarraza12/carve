<?php

namespace App\Http\Model\Checkout;

use Illuminate\Database\Eloquent\Model;

class OrderTotal extends Model
{
    //
    protected $table = 'order_total';
    protected $primaryKey = 'order_total_id';
    protected $connection = 'mysql';
    public $timestamps = false;
}
