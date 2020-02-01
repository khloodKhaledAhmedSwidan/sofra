<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    //
    protected $fillable = array('accountable_id', 'token');

    public function accountable()
    {
        return $this->morphTo();
    }

}
