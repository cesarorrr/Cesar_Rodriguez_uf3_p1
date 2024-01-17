<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BoxofficesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $filmIds = DB::table('films')->pluck('id')->toArray();


        foreach ($filmIds as $filmId) {
            DB::table('boxoffices')->insert([
                'film_id' => $filmId,
                'earnings' => $faker->randomFloat(2, 0, 100000),
                'release_date' => $faker->date(),
                'created_at' => now()->setTimezone('Europe/Madrid'),
            ]);
        }
    }
}
