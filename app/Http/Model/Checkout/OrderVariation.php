<?php

namespace App\Http\Model\Checkout;

use Illuminate\Database\Eloquent\Model;

class OrderVariation extends Model
{
    //
    protected $table = 'order_variation';
    protected $primaryKey = 'order_variation_id';
    protected $connection = 'mysql';
    public $timestamps = false;
}
