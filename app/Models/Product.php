<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'product_price', 'product_image',
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    use HasFactory;
}
