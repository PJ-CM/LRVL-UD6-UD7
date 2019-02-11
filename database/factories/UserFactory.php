<?php

use App\User;
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

//Parece que, al definirla fuera del Faker, esta variable no es accesible...
//  >> Definiendo un ARRAY:
//      -> así
////$_arr_perfil = array('author','user');
//      -> o así
//$_arr_perfil = ['author','user'];
//...ni aunque se le llame con $this->_arr_perfil
//A no ser que haya otra posibilidad mejor,
//definirla dentro del propio Faker para que pueda ser accesible

$factory->define(User::class, function (Faker $faker) {

    return [
        'name' => $faker->name,

        'username' => $faker->unique()->userName,
        'direction' => $faker->streetAddress,
        'phone' => $faker->phoneNumber,
        'country' => $faker->country,

        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret

        'remember_token' => str_random(10),

        'activo' => $faker->numberBetween(0,1),
    ];
});
