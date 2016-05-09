<?php

namespace Ecommerce\Cart;

use Session;
use Ecommerce\Cart\CartRepositoryInterface;

class SessionCartRepository implements CartRepositoryInterface
{
    /**
     * The cart object on Session.
     * 
     * @var Array
     */
    protected $object;

    public function __construct() 
    {
        $this->object = Session::get('cart');
    }

    /**
     * Add a product SKU to the cart.
     * 
     * @param string $sku
     * @param int $qty
     * @return Array
     */
    public function add(CartItem $cartItem) 
    {
        $this->object[$cartItem->sku->id] = $cartItem;

        return $this->_save();
    }

    /**
     * Clear the cart.
     */
    public function clear() 
    {
        Session::forget('cart');
    }

    /**
     * Delete a product SKU from the cart.
     * 
     * @param string $sku
     * @return Array
     */
    public function delete($sku) 
    {
        unset($this->object[$sku]);

        return $this->_save();
    }

    /**
     * Update the cart.
     * 
     * @param array $skus
     * @return Array
     */
    public function update(array $skus) 
    {
        foreach($skus as $sku)
        {
            $cartItem = $this->object[$sku['id']];
            $cartItem->qty = $sku['qty'];
        }

        return $this->_save();
    }

    /**
     * Return all cart.
     * 
     * @return Array
     */
    public function getItems() 
    {
        return $this->object;
    }

    /**
     * Process to add or update a product into the cart.
     * 
     * @return Array
     */
    protected function _addOrUpdate(CartItem $cartItem)
    {
        return $this->add($cartItem);
    }

    /**
     * Save the object.
     * 
     * @param array $cart
     * @return array
     */
    public function _save() 
    {
        Session::put('cart', $this->object);

        return $this->object;
    }
}