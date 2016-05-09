<?php

namespace Ecommerce\Orders;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 
        'sku_id',
        'qty',
        'subtotal',
        'disccont',
        'total'
    ];
    
    /**
     * Fetch the order assotiated with.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order() {
        return $this->belongsTo('Ecommerce\Orders\Order');
    }

    /**
     * Fetch the SKU assotiated with.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sku() {
        return $this->belongsTo('Ecommerce\Products\Skus\Sku');
    }
}