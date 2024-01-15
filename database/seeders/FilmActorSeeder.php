<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $filmIds = DB::table('films')->pluck('id')->toArray();
        $actorIds = DB::table('actors')->pluck('id')->toArray();

        $lastInsertedId = DB::table('films_actors')->max('id');

        foreach ($filmIds as $filmId) {
            $numberOfActors = $faker->numberBetween(1, 3);

            $selectedActorIds = $faker->randomElements($actorIds, $numberOfActors);

            foreach ($selectedActorIds as $actorId) {
                DB::table('films_actors')->insert([
                    'id' => ++$lastInsertedId,
                    'film_id' => $filmId,
                    'actor_id' => $actorId,
                    'created_at' => now()->setTimezone('Europe/Madrid'),
                ]);
            }
        }
    }
}
