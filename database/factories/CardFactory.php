<?php


namespace Database\Factories;


use App\Models\Card;
use App\Models\CardRarity;
use App\Models\ExpansionSet;
use App\Models\PokemonType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Card::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'test_pokmon_name_'.$this->faker->firstName,
            'health_points' => $this->faker->randomNumber(3),
            'is_first_edition' => false,
            'expansion_set_id' => ExpansionSet::all()->random(1)->first()->id,
            'card_rarity_id' => CardRarity::all()->random(1)->first()->id,
            'price' => $this->faker->randomFloat(2, $min = 1, $max = 100),
            'image_url' => $this->faker->url(),
            'created_at' => Carbon::now(),
        ];
    }
}
