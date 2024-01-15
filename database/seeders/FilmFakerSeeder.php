<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $lastInsertedId = DB::table("films")->max("id");
        for ($i = $lastInsertedId; $i < $lastInsertedId + 10; $i++) {
            DB::table("films")->insert(
                [
                    "id" => $i + 1,
                    "name" => $faker->name(),
                    "year" => $faker->year(),
                    "genre" => $faker->randomElement(['Action', 'Drama', 'Comedy', 'Sci-Fi']),
                    "country" => $faker->country(),
                    "duration" => $faker->numberBetween(30, 240),
                    "img_url" => $faker->imageUrl(),
                    "created_at" => now()->setTimezone('Europe/Madrid'),
                ]
            );
        }
    }
}
