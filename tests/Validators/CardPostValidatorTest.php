<?php

namespace Test\Validators;

use App\Http\Validators\CardPostValidator;

class CardPostValidatorTest extends \TestCase
{

    /**
     * @test
     */
    public function should_validate_post_card_data()
    {
        $data = [
            'name' => 'nonpokemonname',
            'health_points' => 60,
            'is_first_edition' => 1,
            'is_taken' => 0,
            'expansion_set' => 1,
            'pokemon_type' => [4,12],
            'card_rarity' => 2,
            'price' => 10.75,
            'image_url' => 'https =>//den-cards.pokellector.com/119/Ivysaur.BS.30.png'
        ];
        $card_validator = new CardPostValidator($data);
        $result = $card_validator->validate();

        $this->assertTrue($result);
        $this->assertNull($card_validator->getErrors());
    }
}
