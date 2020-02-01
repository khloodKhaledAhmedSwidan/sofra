<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Restaurant extends Authenticatable
{

    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('payment_value','name', 'email', 'phone', 'region_id', 'password', 'minimum', 'delivery_charge', 'pin_code',  'availability', 'photo', 'processing_time', 'whatsapp','is_active');

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category','category_restaurants');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function notifications()
    {
        return $this->morphToMany('App\Models\Notification', 'notifiable');
    }
    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function tokens(){
        return $this->morphMany('App\Models\Token','accountable');
    }
    protected $hidden = [
        'password', 'api_token'
    ];

}
