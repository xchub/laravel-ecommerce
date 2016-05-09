<?php

namespace Ecommerce\Orders;

use Auth;
use Ecommerce\Cart\Cart;
use Ecommerce\Orders\Order as Model;
use Ecommerce\Orders\OrderRepositoryInterface;

class DbOrderRepository implements OrderRepositoryInterface
{
    /**
     * Create a order.
     *
     * @param \Ecommerce\Cart\Cart $cart
     */
    public function create(Cart $cart)
    {
        $user = Auth::user();

        $order = $user->customer->orders()->create([
            'subtotal' => 0,
            'disccount' => 0,
            'total' => 0
        ]);

        $items = $cart->getItems();

        foreach($items as $item)
        {
            $order->details()->create([
                'sku_id' => $item->sku->id,
                'price' => $item->sku->price,
                'qty' => $item->qty,
                'subtotal' => $item->getSubtotal(),
                'disccount' => 0,
                'total' => $item->getSubtotal()
            ]);
        }

        $order->subtotal = $cart->getSubtotal();

        $order->disccount = 0;

        $order->total = $order->subtotal - $order->disccount;
        
        $order->save();

        return $order;
    }

    /**
     * Fetch all orders.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Model::all();
    }
}