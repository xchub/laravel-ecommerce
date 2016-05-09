<?php

namespace Ecommerce\Products\Images;

interface ImageRepositoryInterface 
{
    public function save(array $files, $productId);
    
    public function delete($id);
}
