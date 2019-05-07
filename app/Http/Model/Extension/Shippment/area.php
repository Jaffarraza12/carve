<?php

namespace App\Http\Model\Extension\Shippment;

use Illuminate\Database\Eloquent\Model;
use App\Http\model\localization\Zone;
use App\Http\model\localization\ZoneCity;

class area extends Model
{
    //
    protected $table = 'shipping_rate';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';

    public  function getCost($zone,$city,$weight=0.5){
        if($zone == 2462) {
            if($city == 41){
                $z = 'wz';
            } else {
                $z = 'sz';
            }
        } else {
            $z = 'dc';
        }
        if($weight <=0.5 )
        {
            $w= 0.5;
        } else {
            $w = ceil($weight);
        }
        //$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "shipping_rate WHERE zone = '".$z."' AND weight= '" . $w . "' ");
        $area = area::where('zone',$z)->where('weight',$w)->first();
        return  $area;

    }
}
