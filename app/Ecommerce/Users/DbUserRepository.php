<?php

namespace Ecommerce\Users;

use Ecommerce\Users\User as Model;
use Ecommerce\Users\UserRepositoryInterface;

class DbUserRepository implements UserRepositoryInterface
{
    /**
     * Create a user.
     * 
     * @param array $data
     * @param int $customerId
     * @return Model
     */
    public function create(array $data, $customerId = null)
    {
        if($customerId){
            $data['customer_id'] = $customerId;
        }

        $data['password'] = bcrypt($data['password']);

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