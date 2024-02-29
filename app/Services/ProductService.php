<?php

namespace App\Services;

use App\Models\Product;
use App\Models\SubCategory;

class ProductService
{
    public function onSaleProducts()
    {
        $products = Product::where('sale_price', '>', '0')->inRandomOrder()->limit(8)->get();

        return $products;
    }

    public function latestProduct()
    {
        $products = Product::limit(10)->orderBy('created_at', 'desc')->get();

        return $products;
    }

    public function relatedProduct($category_id)
    {
        $products = Product::where('category_id', $category_id)->limit(8)->inRandomOrder()->get();

        return $products;
    }

    public function categoryWithProducts()
    {
        $products = SubCategory::with('products')->limit(10)->inRandomOrder()->get();

        return $products;
    }

    public function getProduct($slug)
    {
        $product = Product::whereSlug($slug)->first();

        return $product;
    }
}