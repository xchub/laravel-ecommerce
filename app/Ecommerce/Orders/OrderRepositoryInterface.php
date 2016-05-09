<?php

namespace Ecommerce\Orders;

interface OrderRepositoryInterface 
{
    public function getAll();

    public function create(\Ecommerce\Cart\Cart $cart);
}