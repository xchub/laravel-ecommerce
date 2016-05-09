<?php

use Illuminate\Database\Seeder;

use Ecommerce\Products\Product;
use Ecommerce\Products\Skus\Sku;
use Ecommerce\Products\Images\Image;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 10)->create()->each(function($u) {
            $u->skus()->saveMany(factory(Sku::class, 2)->make());
            $u->images()->save(factory(Image::class, 1)->make());
        });
    }
}