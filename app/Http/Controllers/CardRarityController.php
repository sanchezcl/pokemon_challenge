<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnumResourceCollection;
use App\Models\CardRarity;

class CardRarityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/card_rarities",
     *     operationId="/card_rarities",
     *     tags={"CardRarity"},
     *     @OA\Response(
     *         response="200",
     *         description="List rarity card avaliable",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/enumJson")
     *         ),
     *     ),
     *
     * )
     */
    public function index()
    {
        return new EnumResourceCollection(CardRarity::all());
    }
}
