<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredients')->insert([
            'name' =>fake()->word(),
            'supplier' =>fake()->name(),
            'measure' => "kg",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('ingredients')->insert([
            'name' =>fake()->word(),
            'supplier' =>fake()->name(),
            'measure' => "g",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('ingredients')->insert([
            'name' =>fake()->word(),
            'supplier' =>fake()->name(),
            'measure' => "pieces",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
