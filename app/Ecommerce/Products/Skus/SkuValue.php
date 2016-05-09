<?php

namespace Ecommerce\Products\Skus;

use Illuminate\Database\Eloquent\Model;

class SkuValue extends Model
{
    protected $fillable = [
        'product_id',
        'variant_id',
        'option_id',
        'sku_id'
    ];
    
    /**
     * Fetch the product associated with.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product() {
        return $this->belongsTo('Ecommerce\Products\Product');
    }
    
    /**
     * Fetch the variant associated with.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function variant() {
        return $this->belongsTo('Ecommerce\Products\Variants\Variant');
    }
    
    /**
     * Fetch the value of the variant associated with.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function option() {
        return $this->belongsTo('Ecommerce\Products\Variants\Options\Option');
    }
}