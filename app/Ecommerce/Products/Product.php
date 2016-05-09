<?php

namespace Ecommerce\Products;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'slug',
        'main_image',
        'bundle'
    ];

    /**
     * Get the route key for the model.
     * 
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * List of orders including the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function orders() {
        return $this->belongsToMany('Ecommerce\Orders\Order');
    }

    /**
     * Fetch all skus associated with the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skus() {
        return $this->hasMany('Ecommerce\Products\Skus\Sku');
    }
    
    /**
     * Fetch all variants associated with the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variants() {
        return $this->hasMany('Ecommerce\Products\Variants\Variant');
    }

    /**
     * Fetch all variant values associated with the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variantOptions() {
        return $this->hasMany('Ecommerce\Products\Variants\Options\VariantOption');
    }
    
    /**
     * Fetch all sku values associated with the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skuValues() {
        return $this->hasMany('Ecommerce\Products\Skus\SkuValue');
    }
    
    /**
     * Fetch all images associated with the product.
     * 
     * @return type
     */
    public function images() {
        return $this->hasMany('Ecommerce\Products\Images\Image');
    }
}