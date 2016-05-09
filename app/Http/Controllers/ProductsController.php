<?php

namespace App\Http\Controllers;

use Ecommerce\Products\ProductRepositoryInterface;

class ProductsController extends Controller
{
    /**
     * @var ProductRepositoryInterface
     */
    protected $repo;

    public function __construct(ProductRepositoryInterface $repo) 
    {
        $this->repo = $repo;
    }

    /**
     * Render a view of list of products.
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function catalog() 
    {
        $products = $this->repo->getAllPaginated();

        $products->load('images');

        return view('products.catalog', [
            'products' => $products
        ]);
    }

    /**
     * Render a view of product details.
     * 
     * @param string $slug
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function detail($slug)
    {
        $product = $this->repo->findBySlug($slug);
        
        $product->load('images');

        $product->variants = $this->repo->variants($product->id);

        return view('products.detail', [
            'product' => $product
        ]);
    }
}