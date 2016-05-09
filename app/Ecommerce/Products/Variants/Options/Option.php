<?php

namespace Ecommerce\Products\Variants\Options;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'variant_id',
        'title'
    ];

    public function skuValue() {
        return $this->belongsTo('Ecommerce\Products\Skus\SkuValue');
    }
}