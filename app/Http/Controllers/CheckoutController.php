<?php

namespace App\Http\Controllers;

use DB;
use Ecommerce\Cart\Cart;
use App\Http\Requests\OrderRequest;
use Ecommerce\Events\OrderWasPurchased;
use Ecommerce\Orders\OrderRepositoryInterface;

class CheckoutController extends Controller
{
    /**
     * The cart repository.
     *
     * @var CartRepositoryInterface
     */
    protected $cart;

    /**
     * The order repository
     * @var OrderRepositoryInterface
     */
    protected $order;

    public function __construct(OrderRepositoryInterface $order, Cart $cart)
    {
        $this->cart = $cart;

        $this->order = $order;
    }

    /**
     * Show the summary of order.
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function index()
    {
        try
        {
            if($this->cart->isEmpty()){
                throw new \Exception('Your cart is empty');
            }

            return view('checkout.index', [
                'cart' => $this->cart
            ]);
        } 
        catch (\Exception $ex) 
        {
            return redirect()
                    ->route('cart')
                    ->with('checkout_error', $ex->getMessage());
        }
    }

    /**
     * Regiter the order.
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function complete(OrderRequest $request)
    {
        try
        {
            DB::beginTransaction();

            if($this->cart->isEmpty()){
                throw new \Exception('Your cart is empty');
            }

            $order = $this->order->create($this->cart);

            DB::commit();
            
            event(new OrderWasPurchased($order));

            $this->cart->clear();

            return redirect()
                    ->route('checkout.confirmation', $order->id);
        }
        catch (\Exception $ex)
        {
            DB::rollback();

            return redirect()
                    ->route('checkout')
                    ->with('checkout_error', 'An error occurred during your order.');
        }
    }

    /**
     * Show the confirmation screen.
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function confirmation(\Ecommerce\Orders\Order $order)
    {
        return view('checkout.confirmation', [
            'order' => $order
        ]);
    }

    public function error()
    {
        return 'Error order';
    }
}