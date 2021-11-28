<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PokemonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date = Carbon::now();
        DB::table('pokemon_types')->insert([
                ['name' => 'normal', 'created_at' => $current_date,],
                ['name' => 'fighting', 'created_at' => $current_date,],
                ['name' => 'flying', 'created_at' => $current_date,],
                ['name' => 'poison', 'created_at' => $current_date,],
                ['name' => 'ground', 'created_at' => $current_date,],
                ['name' => 'rock', 'created_at' => $current_date,],
                ['name' => 'bug', 'created_at' => $current_date,],
                ['name' => 'ghost', 'created_at' => $current_date,],
                ['name' => 'steel', 'created_at' => $current_date,],
                ['name' => 'fire', 'created_at' => $current_date,],
                ['name' => 'water', 'created_at' => $current_date,],
                ['name' => 'grass', 'created_at' => $current_date,],
                ['name' => 'electric', 'created_at' => $current_date,],
                ['name' => 'psychic', 'created_at' => $current_date,],
                ['name' => 'ice', 'created_at' => $current_date,],
                ['name' => 'dragon', 'created_at' => $current_date,],
                ['name' => 'dark', 'created_at' => $current_date,],
                ['name' => 'fairy', 'created_at' => $current_date,],
            ]
        );
    }
}
