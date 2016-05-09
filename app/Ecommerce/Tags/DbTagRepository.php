<?php

namespace Ecommerce\Tags;

use Ecommerce\Tags\Tag as Model;
use Ecommerce\Customers\TagRepositoryInterface;

class DbTagRepository implements TagRepositoryInterface
{
    /**
     * Fetch all tags.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll() 
    {
        return Model::all();
    }
}