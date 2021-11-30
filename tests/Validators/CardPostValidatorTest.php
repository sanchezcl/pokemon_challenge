<?php

namespace Test\Validators;

use App\Http\Validators\CardPostValidator;
use Illuminate\Validation\ValidationException;

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

    /**
     * @test
     * @expectedException
     */
    public function should_throw_validation_error_on_post_card()
    {
        $data = [
            'name' => 'nonpokemonname',
            'health_points' => "60",
            'is_first_edition' => 0.665,
            'is_taken' => "cierto",
            'expansion_set' => 1,
            'pokemon_type' => "fire",
            'card_rarity' => true,
            'price' => "ten and five cents",
            'image_url' => 'https =>//den-cards.pokellector.com/119/Ivysaur.BS.30.png'
        ];
        $card_validator = new CardPostValidator($data);

        $this->expectException(ValidationException::class);
        $card_validator->validate();
    }
}
