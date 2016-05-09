<?php

namespace Ecommerce\Listeners;

use Ecommerce\Events\OrderWasPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class EmailPurchaseConfirmation implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  OrderWasPurchased  $event
     * @return void
     */
    public function handle(OrderWasPurchased $event)
    {
        $order = $event->order;

        Mail::send('emails.purchased', ['order' => $order], 
            function ($m) use ($order) {
                $m->to($order->customer->email, $order->customer->name)
                  ->subject('Order confirmation');
            });
    }
}