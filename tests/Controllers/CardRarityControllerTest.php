<?php

namespace Tests\Controllers;

use App\Http\Resources\EnumResource;

class CardRarityControllerTest extends \TestCase
{

    public function testIndex()
    {
        $this->get('/card_rarities');

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
