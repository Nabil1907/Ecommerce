<?php

use Faker\Generator as Faker;

$factory->define(App\Property::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->text($maxNbChars = 50, $indexSize = 2) ,
    	'body' => $faker->text,
    	'info' => $faker->text,
    	'size' => 's',
    	'category' => 'jacket',
    	'quantity' => '1',
    	'color' => 'black',
    	'price' => '90',
    	'sex' => 'woman',
    	'image' => '1537808485.',
    ];
});
