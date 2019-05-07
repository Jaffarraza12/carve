<?php

namespace App\Http\model\localization;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    //
    protected $table = 'zone';
    protected $primaryKey = 'zone_id';
    protected $connection = 'mysql';
}
