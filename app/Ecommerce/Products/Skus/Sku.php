<?php

namespace Ecommerce\Products\Skus;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Sku extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $casts = [
        'id' => 'string'
    ];

    protected $fillable = [
        'id',
        'product_id',
        'main',
        'stock',
        'before_price',
        'price'
    ];

    /**
     * Fetch the product associated with the SKU.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product() {
        return $this->belongsTo('Ecommerce\Products\Product');
    }
    
    /**
     * Fetch all order details associated with the SKU.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails() {
        return $this->hasMany('Ecommerce\Orders\OrderDetail');
    }
    
    /**
     * Fetch the sku values.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skuValue() {
        return $this->hasMany('Ecommerce\Products\Skus\SkuValue');
    }
    
    /**
     * Fetch the options os variants associated with.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function options() {
        return $this->belongsToMany('Ecommerce\Products\Variants\Options\Option', 
                'sku_values');
    }

    /**
     * Fetch the main SKU of the project.
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeMain($query) {
        return $query;//->where('main', 1);
    }
}