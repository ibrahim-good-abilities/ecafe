<?php

namespace App;

use App\Item;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['category_name', 'src'];
    //
    public function Item()
    {
        return $this->hasMany(Item::class);
    }
}
