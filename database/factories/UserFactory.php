<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\CartItem;
use App\Category;
use App\MenuItem;
use App\User;
use App\Variation;
use App\VariationOption;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'phone_number' => '232131123',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'user_type' => 'customer'
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => $faker->word,
        'image' => $faker->word.'.png'
    ];
});

$factory->define(MenuItem::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'category_id' => function () {
            return create('App\Category')->id;
        },
        'image' => $faker->word.'.png',
        'description' => $faker->paragraph,
        'price' => $faker->numberBetween(100,500),
        'is_popular' => false
    ];
});

$factory->define(Variation::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'subtitle' => $faker->sentence,
    ];
});

$factory->define(VariationOption::class, function (Faker $faker) {
    return [
        'variation_id' => function () {
            return create('App\Variation')->id;
        },
        'option' => $faker->word
    ];
});

$factory->define(CartItem::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return create('App\User')->id;
        },
        'menu_item_id' => function() {
            return create('App\MenuItem')->id;
        },
        'quantity' => $faker->numberBetween(1,5)
    ];
});