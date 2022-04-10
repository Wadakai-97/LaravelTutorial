<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    $company_id = Company::pluck('id')->all();

    return [
        'company_id' => $faker->randomElement($company_id),
        'product_name' => $faker->word(),
        'price' => $faker->randomNumber(4),
        'stock' => $faker->randomNumber(2),
        'comment' => $faker->realText(80),
        'img_path' => $faker->imageUrl(),
        'created_at' => $faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
        'updated_at' => $faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});
