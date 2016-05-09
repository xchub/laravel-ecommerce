<?php

namespace Ecommerce\Customers;

use Ecommerce\Customers\Customer as Model;
use Ecommerce\Customers\CustomerRepositoryInterface;

class DbCustomerRepository implements CustomerRepositoryInterface
{
    /**
     * Create a customer.
     * 
     * @param array $data
     * @return Customer
     */
    public function create(array $data) 
    {
        return Model::create($data);
    }

    /**
     * Find a customer by ID.
     * 
     * @param int $id
     * @return Customer
     */
    public function find($id) {
        return Model::findOrFail($id);
    }

    /**
     * Fetch all customers.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll() 
    {
        return Model::all();
    }
}