<?php

namespace Ecommerce\Products\Variants\Options;

interface OptionRepositoryInterface 
{
    public function find($id);
            
    public function save($data, $productId, $variantId);
}