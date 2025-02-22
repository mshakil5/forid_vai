<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function book()
    {
        return $this->hasMany(Book::class);
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function categoryProducts()
    {
        return $this->hasMany(CategoryProduct::class);
    }
}
