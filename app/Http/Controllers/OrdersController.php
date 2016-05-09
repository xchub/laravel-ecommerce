<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Ecommerce\Orders\OrderRepositoryInterface;

class OrdersController extends Controller
{
    /**
     * @var OrderRepositoryInterface
     */
    protected $repo;

    public function __construct(OrderRepositoryInterface $repo) 
    {
        $this->repo = $repo;
    }

    public function index() 
    {
        dd($this->repo->getAll());
    }
}
