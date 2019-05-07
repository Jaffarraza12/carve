<?php

namespace App\Http\Model\Catalog;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    //
    protected $table = 'product_to_category';
    protected $connection = 'mysql';
}
