<?php

namespace Database\Seeders;

use App\Models\Card;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date = Carbon::now();
        $data = collect([
            [
                'name' => 'charizard',
                'health_points' => 120,
                'is_first_edition' => true,
                'expansion_set_id' => $this->getFoeringKeyIdByName('base set 2', 'expansion_sets'),
                'card_pokemon_types' => ['fire'],
                'card_rarity_id' => $this->getFoeringKeyIdByName('rare', 'card_rarities'),
                'price' => 20.99 * 100,
                'image_url' => 'https://den-cards.pokellector.com/119/Charizard.BS.4.png',
                'created_at' => $current_date,
            ],
            [
                'name' => 'squirtle',
                'health_points' => 40,
                'is_first_edition' => true,
                'expansion_set_id' => $this->getFoeringKeyIdByName('base set', 'expansion_sets'),
                'card_pokemon_types' => ['water'],
                'card_rarity_id' => $this->getFoeringKeyIdByName('common', 'card_rarities'),
                'price' => 20.99 * 100,
                'image_url' => 'https://den-cards.pokellector.com/119/Squirtle.BS.63.png',
                'created_at' => $current_date,
            ],
            [
                'name' => 'venusaur',
                'health_points' => 100,
                'is_first_edition' => true,
                'expansion_set_id' => $this->getFoeringKeyIdByName('base set 2', 'expansion_sets'),
                'card_pokemon_types' => ['grass', 'poison'],
                'card_rarity_id' => $this->getFoeringKeyIdByName('rare', 'card_rarities'),
                'price' => 20.99 * 100,
                'image_url' => 'https://den-cards.pokellector.com/122/Venusaur.B2.18.png',
                'created_at' => $current_date,
            ],
        ]);
        $data->each(function ($card_attributes) {
            $type_ids = collect($card_attributes['card_pokemon_types'])->map(function($type){
                return $this->getFoeringKeyIdByName($type, 'pokemon_types');
            });
            unset($card_attributes['card_pokemon_types']);
            Card::create($card_attributes)->pokemonTypes()->attach($type_ids);
        });

    }

    private function getFoeringKeyIdByName($name, $table)
    {
        return DB::table($table)->where('name', $name)->first()->id;
    }
}
