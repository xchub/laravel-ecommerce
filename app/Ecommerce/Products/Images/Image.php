<?php

namespace Ecommerce\Products\Images;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model 
{
    use SoftDeletes;
    
    protected $fillable = [
        'product_id',
        'image'
    ];
}