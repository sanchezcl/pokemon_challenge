<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpansionSetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date = Carbon::now();
        DB::table('expansion_sets')->insert([
            ['name' => 'base set', 'created_at' => $current_date],
            ['name' => 'jungle', 'created_at' => $current_date],
            ['name' => 'fossil', 'created_at' => $current_date],
            ['name' => 'base set 2', 'created_at' => $current_date],
            ['name' => 'team rocket', 'created_at' => $current_date],
            ['name' => 'gym heroes', 'created_at' => $current_date],
            ['name' => 'gym challenge', 'created_at' => $current_date],
        ]);
        //
    }
}
