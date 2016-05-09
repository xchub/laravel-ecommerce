<?php

namespace Ecommerce\Events;

use App\Events\Event;
use Ecommerce\Customers\Customer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CustomerHasRegistered extends Event
{
    use SerializesModels;

    public $customer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
