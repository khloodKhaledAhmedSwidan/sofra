<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'region_id', 'password', 'photo', 'pin_code','is_active');
    protected $hidden = [
        'password', 'api_token'
    ];
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


    public function tokens(){
        return $this->morphMany('App\Models\Token','accountable');
    }
public function contacts(){
        return $this->hasMany('App\Models\Contact');
}
}
