<?php

namespace App\Http\model\Extension\Payment;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\Checkout\Cart;

class cod extends Model
{
    //
    public function doPayment($request)
    {

        $payment = array();
        if($request->total <=2000) {
            $payment['status'] = 'Processing';
            return $payment;
        } else {
            $json = array();
            $json['error']['payment'] = 'FOR COD Payment should be less 2,000';
            echo json_encode($json);
            return false;
        }

    }
}
