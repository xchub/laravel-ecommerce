<?php

namespace Ecommerce\Customers;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * Table related.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email'
    ];

    /**
     * The orders of the customer.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders() {
        return $this->hasMany('Ecommerce\Orders\Order');
    }
    
    /**
     * User associated with the customer account.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->hasOne('Ecommerce\Users\User');
    }
}