<?php

namespace App\Http\Model\Checkout;

use Illuminate\Database\Eloquent\Model;

class OrderNotes extends Model
{
    //
    protected $table = 'order_notes';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';
}
