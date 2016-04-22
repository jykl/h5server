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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'authority' => random_int(0,4),
        'remember_token' => str_random(10),
    ];
});
$factory->define(\App\Element::class,function(Faker\Generator $faker){
    return [
        'name'=>$faker->name,
        'e_type'=>random_int(0,2),
        'user_id'=>random_int(1,5),
        'parent_id' => random_int(0, 100),
        'grade_subject' => '0'.random_int(1,3).'0'.random_int(1,3),
        'content_type' => random_int(0, 16),
    ];
});

$factory->define(\App\Courseware::class, function (Faker\Generator $faker) {

    return [
        'user_id' => random_int(1, 5),
        'c_type' => random_int(0, 3),
        'score'=>random_int(0,5),
        'label'=>$faker->name,
        'position_id'=>'0'.random_int(1,3).'0'.random_int(1,3).'0'.random_int(1,3).'0'.random_int(1,3).'0'.random_int(1,3).'0'.random_int(1,3).'0'.random_int(1,3),

    ];
});


/*$factory->define(App\Task::class, function (Faker\Generator $faker) {
    return [
        'name' => str_random(10),
    ];
});*/

