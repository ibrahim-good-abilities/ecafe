<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Customer');

    }
    public function items(){
        return $this->belongsToMany('App\Item');
    }
}
