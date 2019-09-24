<?php

namespace App;

use App\Item;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['category_name', 'src'];
    //
    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
