<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image'];

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'category_id','title');
    }

    public function desc(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\Product', 'category_id','description');
    }
}
