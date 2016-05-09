<?php

namespace Ecommerce\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'name', 
        'email', 
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Fetch the costumer associated with the user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer() {
        return $this->belongsTo('Ecommerce\Customers\Customer');
    }
}