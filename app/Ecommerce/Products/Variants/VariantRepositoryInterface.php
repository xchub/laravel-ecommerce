<?php

namespace Ecommerce\Products\Variants;

interface VariantRepositoryInterface 
{
    public function save($data, $productId);
}