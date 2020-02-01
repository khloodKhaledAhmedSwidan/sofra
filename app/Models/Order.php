<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('special_order', 'restaurant_id', 'client_id', 'cost', 'net', 'total', 'commission', 'state');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('amount','price','notes');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

}
