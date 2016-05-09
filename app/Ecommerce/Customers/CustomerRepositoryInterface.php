<?php

namespace Ecommerce\Customers;

interface CustomerRepositoryInterface 
{
    public function create(array $data);
    
    public function getAll();
    
    public function find($id);
}