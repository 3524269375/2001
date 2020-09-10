<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BrandModel;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(BrandModel::class, function (Faker $faker) {
    return [
        'brand_name' => $faker->name,
        'brand_url' => str::random(10).'@gmail.com',
        'brand_logo' => 'http://img.2001.com/upload/Z1zzXi5nKRjMJuffATF0kNSO3Ch9KTAIOYnzxNJ1.jpeg',
        'brand_desc' => str::random(10), // password
        'created_at' => date('Y-m-d H:i:s',time()),
        'updated_at' => date('Y-m-d H:i:s',time()),
    ];
});
