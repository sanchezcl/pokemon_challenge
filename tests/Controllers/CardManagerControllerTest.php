<?php

namespace Test\Controllers;

use App\Http\Controllers\CardManagerController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Card;

class CardManagerControllerTest extends \TestCase
{

    public function testTakeCard()
    {
        $card = Card::all()->random(1)->first();
        $this->call(
            'PATCH',
            route('card.take_card', ['id' => $card->id])
        );

        $this->assertResponseOk();
        $this->assertJson($this->response->content());
    }

    public function testReturnAllCards()
    {
        $card = Card::all()->random(1)->first();
        $this->call(
            'PATCH',
            route('card.return_card', ['id' => $card->id])
        );

        $this->assertResponseOk();
        $this->assertJson($this->response->content());
    }

    public function testReturnCard()
    {
        $card = Card::all()->random(1)->first();
        $this->call(
            'PATCH',
            route('card.return_all', ['id' => $card->id])
        );

        $this->assertResponseStatus(Response::HTTP_ACCEPTED);
        $this->assertJson($this->response->content());
    }
}
