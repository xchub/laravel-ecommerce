<?php

namespace Ecommerce\Cart;

use Ecommerce\Products\Skus\Sku;
use Ecommerce\Cart\CartRepositoryInterface;

class Cart 
{
    /**
     * The cart repository.
     * 
     * @var CartRepositoryInterface
     */
    protected $repo;

    public function __construct(CartRepositoryInterface $repo) 
    {
        $this->repo = $repo;
    }

    /**
     * Add a sku product to cart.
     * 
     * @param string $sku
     * @param int $qty
     */
    public function add(Sku $sku, $qty)
    {
        $this->repo->add(new CartItem($sku, $qty));
    }
    
    /**
     * Update the cart.
     * 
     * @param array $skus
     */
    public function update(array $skus)
    {
        $this->repo->update($skus);
    }

    /**
     * Delete a SKU product to cart.
     * 
     * @param string $sku
     */
    public function delete($sku)
    {
        $this->repo->delete($sku);
    }

    /**
     * Get the subtotal of the order.
     * 
     * @return float
     */
    public function getSubtotal() 
    {
        $subtotal = 0;

        foreach($this->repo->getItems() as $item){
            $subtotal+= $item->sku->price * $item->qty;
        }

        return $subtotal;
    }
    
    /**
     * Return the number of items added.
     * 
     * @return int
     */
    public function getNumberOfItems() 
    {
        return count($this->repo->getItems());
    }

    /**
     * Fetch all products added to car.
     * 
     * @return Array
     */
    public function getItems() 
    {
        return $this->repo->getItems();
    }

    /**
     * Clear the cart.
     */
    public function clear() 
    {
        $this->repo->clear();
    }
    
    /**
     * Check if the cart is empty.
     * 
     * @return boolean
     */
    public function isEmpty() {
        return $this->getNumberOfItems() ? false : true;
    }
}