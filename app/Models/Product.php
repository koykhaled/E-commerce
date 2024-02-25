<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'description',
        'regular_price',
        'sale_price',
        'stock_status',
        'quantity',
        'SKU',
        'image',
    ];

    public static function boot()
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        parent::boot();
    }

    public function category()
    {
        return $this->belongsTo(SubCategory::class, 'category');
    }
}