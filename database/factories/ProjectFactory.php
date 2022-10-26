<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'name' => ['de' => ucfirst($faker->words(5, true)), 'en' => ''],
        'location' => ['de' => $faker->city, 'en' => ''],
        'description' => ['de' => $faker->text(200), 'en' => ''],
        'info' => ['de' => $faker->text(100), 'en' => ''],
        'type' => ['de' => ucfirst($faker->words(2, true)), 'en' => ''],
        'year' => $faker->year(),
        'category' => $faker->numberBetween(1,7),
        'state' => $faker->numberBetween(1,4),
        'program_id' => $faker->numberBetween(1,4),
        'has_detail' => $faker->numberBetween(0,1),
        'publish' => 1,
    ];
});
