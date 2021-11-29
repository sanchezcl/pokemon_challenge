<?php

namespace Http\Controllers;

use App\Http\Controllers\CardController;
use App\Models\Card;

class CardControllerTest extends \TestCase
{
    /**
     * @skip
     */
    public function testIndex()
    {
        $this->markTestIncomplete('todo');
    }

    public function testStore()
    {
        $this->markTestIncomplete('todo');
    }

    public function testShow()
    {
        $cards = Card::all()->random(2);
        $cards->each(function($card){
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
        $this->markTestIncomplete('todo');
    }

    public function testDestroy()
    {
        $this->markTestIncomplete('todo');
    }
}
