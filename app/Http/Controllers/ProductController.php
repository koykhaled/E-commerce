<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    protected $product_service;


    /**
     * create instance from ProductService
     * to access functionality inside it 
     */
    public function __construct(ProductService $product_service)
    {
        $this->product_service = $product_service;
    }


    /**
     * Display the products index page.
     *
     * @param array $sale_products An array of sale products.
     * @param array $latest_products An array of latest products.
     * @param array $category_with_products An array of categories with their associated products.
     * @return \Illuminate\View\View The view instance for the products index page.
     */
    public function index()
    {
        $sale_products = $this->product_service->onSaleProducts();

        $latest_products = $this->product_service->latestProduct();

        $category_with_products = $this->product_service->categoryWithProducts();

        return view('products.index', compact('sale_products', 'latest_products', 'category_with_products'));

    }


    /**
     * Display the details of a product.
     *
     * @param string $slug The slug of the product.
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse The view for the product details or a redirect response.
     */
    public function show($slug)
    {
        try {
            $product = $this->product_service->getProduct($slug);

            $related_products = $this->product_service->relatedProduct($product->category_id);

            if (!$product) {
                throw new Exception("Product Not Found!!");
            }

            return view('products.detail', compact('product', 'related_products'));
        } catch (Exception $e) {
            // add notification to display the error
            return to_route(('products.index'));
        }
    }

}