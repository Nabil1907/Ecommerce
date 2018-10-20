 <?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
    	'title' => $faker->name,
    	'body' => $faker->name,
    	'info' => $faker->name,
    	'size' => 's',
    	'image' => 's',
    	'category' => 'sunglasses',
    	'quantity' => '1',
    	'color' => 'black',
    	'price' => '200',
    	'sex' => 'man',
    	'image' => 'default.jpej',
        //
    ];
});
