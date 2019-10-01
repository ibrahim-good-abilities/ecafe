<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Customer');

    }
    public function items(){
        return $this->belongsToMany('App\Item','order_line');
    }
    public function coupon()
    {
        return $this->belongsTo('App\Coupon');
    }
}
