<?php

namespace App\Http\model\localization;

use Illuminate\Database\Eloquent\Model;

class ZoneCity extends Model
{
    //
    protected $table = 'zone_city';
    protected $primaryKey = 'zone_city_id';
    protected $connection = 'mysql';
}
