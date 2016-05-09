<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use Ecommerce\Cart\Cart;
use Ecommerce\Products\ProductRepositoryInterface;
use Ecommerce\Products\Skus\SkuRepositoryInterface;

class CartController extends Controller
{
    /**
     * The cart repository.
     *
     * @var Cart
     */
    protected $cart;
    
    /**
     * The product repository.
     * @var ProductRepositoryInterface 
     */
    protected $product;
    
    /**
     * The SKU repository.
     * 
     * @var SkuRepositoryInterface 
     */
    protected $sku;

    public function __construct(Cart $cart, 
            ProductRepositoryInterface $product, 
            SkuRepositoryInterface $sku)
    {
        $this->cart = $cart;
        
        $this->sku = $sku;
        
        $this->product = $product;
    }

    /**
     * Show the cart summary.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function summary()
    {
        return view('cart.summary', [
            'cart' => $this->cart
        ]);
    }

    /**
     * Add a product to cart.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $product = $this->product->find($request->get('product_id'));

        $sku = $this->sku->find($request->get('sku'));

        $this->cart->add($sku, $request->get('qty'));

        return redirect()
                ->route('product.detail', $product->slug)
                ->with('cart_success', $product->title . ' added to your cart.');
    }

    /**
     * Update the cart.
     * 
     * @param Request $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function update(Request $request)
    {
        $this->cart->update($request->get('skus'));

        return redirect()
                ->route('cart')
                ->with('cart_success', 'The cart has been updated.');
    }

    /**
     * Delete a product to cart.
     * 
     * @param string $sku
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function delete($sku)
    {
        $this->cart->delete($sku);

        return redirect()
                ->route('cart')
                ->with('cart_success', 
                        'The product has been deleted from the cart.');
    }
}