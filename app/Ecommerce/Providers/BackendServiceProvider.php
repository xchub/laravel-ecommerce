<?php

namespace Ecommerce\Providers;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Ecommerce\Orders\OrderRepositoryInterface', 
                'Ecommerce\Orders\DbOrderRepository');

        $this->app->bind('Ecommerce\Customers\CustomerRepositoryInterface', 
                'Ecommerce\Customers\DbCustomerRepository');

        $this->app->bind('Ecommerce\Products\ProductRepositoryInterface', 
                'Ecommerce\Products\DbProductRepository');

        $this->app->bind('Ecommerce\Cart\CartRepositoryInterface', 
                'Ecommerce\Cart\SessionCartRepository');
        
        $this->app->bind('Ecommerce\Products\Skus\SkuRepositoryInterface', 
                'Ecommerce\Products\Skus\DbSkuRepository');
        
        $this->app->bind('Ecommerce\Users\UserRepositoryInterface', 
                'Ecommerce\Users\DbUserRepository');
        
        $this->app->bind('Ecommerce\Products\Variants\VariantRepositoryInterface', 
                'Ecommerce\Products\Variants\DbVariantRepository');
        
        $this->app->bind('Ecommerce\Products\Variants\Options\OptionRepositoryInterface', 
                'Ecommerce\Products\Variants\Options\DbOptionRepository');
        
        $this->app->bind('Ecommerce\Products\Images\ImageRepositoryInterface', 
                'Ecommerce\Products\Images\DbImageRepository');
    }
}