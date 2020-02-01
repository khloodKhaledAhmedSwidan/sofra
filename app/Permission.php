<?php namespace App;

use Zizaco\Entrust\EntrustPermission;
use App\Role;
class Permission extends EntrustPermission
{
    protected $fillable = [
        'name', 'display_name', 'description','group_id',
    ];
    public  function roles(){
        return $this->belongsToMany('App\Role');
    }
}
