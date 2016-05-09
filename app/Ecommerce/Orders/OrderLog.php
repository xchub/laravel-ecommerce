<?php

namespace Ecommerce\Orders;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'description',
        'status'
    ];
    
    /**
     * Fetch the order associated with the log.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order() {
        return $this->belongsTo('Ecommerce\Orders\Order');
    }
}