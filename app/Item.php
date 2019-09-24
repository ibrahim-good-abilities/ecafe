<?php

namespace App;
use APP\Category;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable =['name','unit','category_id','has_stock','alert-number','price','cost','src'];
    //
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
