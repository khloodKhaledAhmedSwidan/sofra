<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryRestaursnts extends Model 
{

    protected $table = 'category_restaurants';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'category_id');

}