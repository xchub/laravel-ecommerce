<?php

namespace Ecommerce\Cart;

use Ecommerce\Products\Skus\Sku;

class CartItem 
{
    /**
     * The SKU of a prpduct.
     * 
     * @var \Ecommerce\Products\Skus\Sku
     */
    public $sku;

    /**
     * The quantity added.
     * 
     * @var int 
     */
    public $qty;

    public function __construct(Sku $sku, $qty) 
    {
        $this->sku = $sku;

        $this->qty = (int)$qty;
    }

    /**
     * Return the subtotal of the product.
     * 
     * @return float
     */
    public function getSubtotal() 
    {
        return $this->sku->price * (int)$this->qty;
    }
}