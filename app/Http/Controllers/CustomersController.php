<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Ecommerce\Customers\CustomerRepositoryInterface;

class CustomersController extends Controller
{
    /**
     * @var CustomerRepositoryInterface
     */
    protected $repo;

    public function __construct(CustomerRepositoryInterface $repo) 
    {
        $this->repo = $repo;
    }

    public function index() 
    {
        dd($this->repo->getAll());
    }
}
