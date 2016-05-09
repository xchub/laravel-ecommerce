<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Intervention\Image\Facades\Image;

$factory->define(Ecommerce\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(123),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Ecommerce\Products\Product::class, function (Faker\Generator $faker) {
    
    $title = $faker->sentence(3);
    
    return [
        'title' => $title,
        'slug' => str_slug($title, '-'),
        'description' => $faker->text(200)
    ];
});

$factory->define(\Ecommerce\Products\Skus\Sku::class, function (Faker\Generator $faker) {
    $price = $faker->randomFloat(2, 20, 300);
    return [
        'id' => strtoupper(uniqid('SKU')),
        'main' => 0,
        'stock' => 1000,
        'before_price' => $price + 200,
        'price' => $price
    ];
});

$factory->define(\Ecommerce\Products\Images\Image::class, function (Faker\Generator $faker) {

    $image = Image::make($faker->imageUrl(500, 500))
                ->resize(500,500)
                ->encode('data-url');

    return [
        'image' => $image
    ];
});

$factory->define(\Ecommerce\Customers\Customer::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(Ecommerce\Tags\Tag::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(1)
    ];
});