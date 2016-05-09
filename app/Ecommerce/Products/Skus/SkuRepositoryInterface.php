<?php

namespace Ecommerce\Products\Skus;

interface SkuRepositoryInterface
{
    public function find($id);
    
    public function save($skus, $productId);
}
