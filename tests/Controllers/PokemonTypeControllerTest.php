<?php

namespace Http\Controllers;

use App\Http\Controllers\PokemonTypeController;
use App\Http\Resources\EnumResource;

class PokemonTypeControllerTest extends \TestCase
{

    public function testIndex()
    {
        $this->get('/pokemon_type');

        $responseRaw = $this->response->getContent();
        $response = json_decode($responseRaw, true);

        $this->assertResponseOk();
        $this->assertInstanceOf(EnumResource::class, $this->response->getOriginalContent()[0]);
        $this->assertJson($responseRaw);
        $this->assertFalse($this->response->isEmpty());
        $this->assertIsArray($response);
        $this->assertArrayHasKey('data', $response);
        $this->assertGreaterThan(0, count($response['data']));
        $this->assertArrayHasKey('id', $response['data'][0]);
        $this->assertArrayHasKey('name', $response['data'][0]);
    }
}
