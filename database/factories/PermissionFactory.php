<?php

use Faker\Generator as Faker;

$factory->define(\App\Entities\Acl\Permission\Permission::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'name' => strtolower(implode('-',explode(' ',$name))),
        'display_name' => $name,
        'guard_name' => 'web',
    ];
});
