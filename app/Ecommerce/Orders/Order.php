<?php

namespace Ecommerce\Orders;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'subtotal',
        'disccount',
        'total'
    ];

    /**
     * The customer of the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer() {
        return $this->belongsTo('Ecommerce\Customers\Customer');
    }

    /**
     * Log of the order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function log() {
        return $this->hasMany('Ecommerce\Orders\OrderLog');
    }

    /**
     * List of products of this order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function products() {
        return $this->belongsToMany('Ecommerce\Products\Product');
    }
    
    /**
     * Fetch all details of the order.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details() {
        return $this->hasMany('Ecommerce\ORders\OrderDetail');
    }
}