<?php

namespace Ecommerce\Users;

interface UserRepositoryInterface 
{
    public function create(array $data, $customerId = null);

    public function getAll();
    
    public function find($id);
}