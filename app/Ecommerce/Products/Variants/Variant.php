<?php

namespace Ecommerce\Products\Variants;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = [
        'product_id',
        'title'
    ];

    /**
     * Fetch all options associated with the variant.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options() {
        return $this->hasMany('Ecommerce\Products\Variants\Options\Option');
    }
}