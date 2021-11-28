<?php


namespace App\Http\Controllers;


use App\Http\Resources\EnumResourceCollection;
use App\Models\PokemonType;

class PokemonTypeController extends Controller
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
     *     path="/pokemon_type",
     *     operationId="/pokemon_type",
     *     tags={"PokemonType"},
     *     @OA\Response(
     *         response="200",
     *         description="List pokemon types avaliable",
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
        return new EnumResourceCollection(PokemonType::all());
    }
}
