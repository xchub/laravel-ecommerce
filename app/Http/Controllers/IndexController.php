<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Ecommerce\Products\ProductRepositoryInterface;

class IndexController extends Controller
{
    protected $repoProducts;

    public function __construct(ProductRepositoryInterface $repo) 
    {
        $this->repoProducts = $repo;
    }
    public function index() 
    {
        return view('welcome');
    }
}
