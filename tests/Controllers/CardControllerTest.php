<?php

namespace Http\Controllers;

use App\Http\Controllers\CardController;
use App\Models\Card;
use Illuminate\Support\Str;

class CardControllerTest extends \TestCase
{
    /**
     * @skip
     */
    public function testIndex()
    {
        $this->call('GET', route('card.index', ), ['filter[name]' => 'charizard']);
        $this->assertResponseOk();
        $this->assertJson($this->response->content());
    }

    public function testStore()
    {
        $params = [
            "name" => "pokemon__test_name_" . Str::random(5),
            "health_points" => 120,
            "is_first_edition" => true,
            "is_taken" => false,
            "expansion_set" => 1,
            "pokemon_type" => [4, 9],
            "card_rarity" => 2,
            "price" => 11.75,
            "image_url" => "https://den-cards.pokellector.com/".Str::random(5)."/Ivysaur.BS.30.png"
        ];
        $this->call('POST', route('card.store'), $params);
        $this->assertResponseStatus(201);
    }

    public function testShow()
    {
        $cards = Card::all()->random(2);
        $cards->each(function ($card) {
            $this->call('GET', route('card.show', ['id' => $card->id]));
            $responseRaw = $this->response->getContent();
            $response = json_decode($responseRaw, true);

            $card_result = $this->response->getOriginalContent();
            $this->assertJson($responseRaw);
            $this->assertFalse($this->response->isEmpty());
            $this->assertResponseOk();
            $this->assertInstanceOf(Card::class, $card_result);
            $this->assertJson($responseRaw);
            $this->assertEquals($response['data']['id'], $card->id);
            $this->assertEquals($response['data']['name'], $card->name);
            $this->assertEquals($response['data']['health_points'], $card->health_points);
            $this->assertEquals($response['data']['is_first_edition'], $card->is_first_edition);
            $this->assertEquals($response['data']['is_taken'], $card->is_taken);
            $this->assertEquals($response['data']['expansion_set'], $card->expansionSet->name);
            $this->assertIsArray($response['data']['pokemon_type']);
            $this->assertEquals(count($response['data']['pokemon_type']), $card->pokemonTypes->count());
            $this->assertEquals($response['data']['card_rarity'], $card->cardRarity->name);
            $this->assertEquals($response['data']['price'], $card->price);
            $this->assertEquals($response['data']['image_url'], $card->image_url);
            $this->assertEquals($response['data']['created_at'], $card->created_at->format('Y-m-d'));
        });

    }

    public function testUpdate()
    {
        $card = Card::where('name', 'venusaur')->first();
        $params = [
            "name" => "venusaur",
            "health_points" => 120,
            "is_first_edition" => true,
            "is_taken" => false,
            "expansion_set" => 1,
            "pokemon_type" => [4, 9],
            "card_rarity" => 2,
            "price" => 11.75,
            "image_url" => "https://den-cards.pokellector.com/119/Ivysaur.BS.30.png"
        ];
        $this->call('PUT', route('card.update', ['id' => $card->id]), $params);
        $responseRaw = $this->response->getContent();
        $response = json_decode($responseRaw, true);

        $this->assertResponseOk();
        $this->assertEquals($card->id, $response['data']['id']);
        $this->assertEquals($params['health_points'], $response['data']['health_points']);
    }

    public function testDestroy()
    {
        $card = Card::all()->random(1)->first();
        $this->call('DELETE', route('card.delete', ['id' => $card->id]));
        $responseRaw = $this->response->getContent();
        $response = json_decode($responseRaw, true);

        $this->assertResponseStatus(202);
        $this->assertJson($responseRaw);
        $this->assertFalse($this->response->isEmpty());
        $this->assertIsArray($response);
        $this->assertArrayHasKey('message', $response);
        $this->assertEquals(CardController::RESOURCE_DELETED_MESSAGE, $response['message']);
    }
}
