<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'order_id');

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function restaurants()
    {
        return $this->morphedByMany('App\Models\Restaurant', 'notifiable');
    }

    public function clients()
    {
        return $this->morphedByMany('App\Models\Client', 'notifiable');
    }

}