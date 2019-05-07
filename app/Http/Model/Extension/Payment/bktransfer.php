<?php

namespace App\Http\model\Extension\Payment;

use Illuminate\Database\Eloquent\Model;


class bktransfer extends Model
{
    //
    public function doPayment($request)
    {
        $payment = array();
        $payment['status'] = 'Pending';
        return $payment;
    }
}
