<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Ecommerce\Products\Product;

class ProductTest extends TestCase
{
    /**
     * Test adding product to cart.
     *
     * @return void
     */
    public function testAddProduct()
    {
        $total = count(Product::all());
        
        $this->visit('/login')
            ->type('admin@admin.com', 'email')
            ->type('123', 'password')
            ->press('btnLogin')
            ->seePageIs('/')
            ->visit('/admin')
            ->click('Products')
            ->seePageIs('/admin/products')
            ->click('New product')
            ->seePageIs('/admin/products/create')
            ->type('New product title', 'title')
            ->type('Description test', 'description')
            ->select('0', 'bundle')
            ->press('btnCreate');
        
        $totalAfter = count(Product::all());
        
        $this->assertEquals($total+1, $totalAfter);
    }
}
