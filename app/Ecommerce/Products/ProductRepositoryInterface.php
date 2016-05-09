<?php

namespace Ecommerce\Products;

interface ProductRepositoryInterface 
{
    public function find($id);
    
    public function variants($id);
    
    public function findBySlug($slug);

    public function getAll();
    
    public function getAllPaginated($take = 20);

    public function getFeatured($take = 20);
    
    public function findWithVariants($id);
    
    public function delete($id);
    
    public function save($request, $id = null);
}