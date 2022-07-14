<?php

namespace Database\Seeders;

use App\Models\Ingredient;
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
        for ($i=0; $i < 30; $i++) {
            DB::table('ingredients')->insert([
                'name' =>fake()->word(),
                'supplier' =>fake()->name(),
                'measure' => fake()->randomElement(Ingredient::MEASURE_VALUES),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
