<?php

use Faker\Generator as Faker;

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



$factory->define(App\Schedule::class, function (Faker $faker) {
    return [
        'department_id'=>$faker->unique()->numberBetween(1,2),
        'start_time' => '09:00:00',
        'end_time' => '16:00:00',

    ];
});

