<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    public function logs()
    {
        return $this->hasMany('App\Order');
    }
}
