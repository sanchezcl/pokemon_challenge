<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardRaritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date = Carbon::now();
        DB::table('card_rarities')->insert([
            ['name' => 'common', 'created_at' => $current_date],
            ['name' => 'uncommon', 'created_at' => $current_date],
            ['name' => 'rare', 'created_at' => $current_date],
        ]);
    }
}
