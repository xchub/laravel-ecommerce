<?php

namespace Ecommerce\Listeners;

use Ecommerce\Events\CustomerHasRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class EmailCustomerRegisteredConfirmation implements ShouldQueue
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
     * @param  CustomerHasRegistered  $event
     * @return void
     */
    public function handle(CustomerHasRegistered $event)
    {
        $customer = $event->customer;
        Mail::send('emails.welcome', ['customer' => $customer], 
            function ($m) use ($customer) {
                $m->to($customer->email, $customer->name)
                  ->subject('Welcome to Ecommerce');
            });
    }
}