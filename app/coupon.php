<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    //
    public  function order()
    {
        return $this->belongsTo('App\Order');
    }
}
