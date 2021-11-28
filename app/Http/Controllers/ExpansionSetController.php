<?php


namespace App\Http\Controllers;


use App\Http\Resources\EnumResourceCollection;
use App\Models\ExpansionSet;

class ExpansionSetController extends Controller
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
     *     path="/expansion_set",
     *     operationId="/expansion_set",
     *     tags={"ExpansionSet"},
     *     @OA\Response(
     *         response="200",
     *         description="List expansions set card avaliable",
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
        return new EnumResourceCollection(ExpansionSet::all());
    }
}
