<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Sale;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {

    $product_id = Product::pluck('id')->all();

    return [
        'product_id' => $faker->randomElement($product_id),
        'created_at' => $faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
        'updated_at' => $faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});
