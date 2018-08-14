<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
        static  $password;

    return [
        'name' => $faker->name,
        'email'=>$faker->unique()->safeEmail,
        'password'=>$password ?: $password=bcrypt('secret'),
        'remember_token'=>str_random(10),
    ];
});

$factory->define(App\product::class, function (Faker $faker) {


    return [
        'name' => $faker->name,
        'image'=>'uploads/products/job.jpg',
         'description'=>$faker->paragraph(4),
        'price'=>$faker->numberBetween(100,1000)

    ];
});
