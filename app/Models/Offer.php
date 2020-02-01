<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('photo', 'name', 'description', 'from', 'to', 'restaurant_id','cost');

    public function restaursnts()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
    public  function getphotoAttribute($photo){
        return asset('public/'.$photo);
    }

}
