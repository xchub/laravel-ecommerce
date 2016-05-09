<?php

namespace Ecommerce\Cart;

interface CartRepositoryInterface 
{
    public function add(CartItem $cartItem);

    public function delete($sku);

    public function update(array $skus);

    public function getItems();
    
    public function clear();
}
