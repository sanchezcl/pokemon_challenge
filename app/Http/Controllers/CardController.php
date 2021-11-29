<?php

namespace App\Http\Controllers;

use App\Http\Validators\CardPutValidator;
use App\Repositories\CardRepositoryInterface;
use App\Http\Resources\CardResource;
use App\Http\Validators\CardPostValidator;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CardController extends Controller
{

    private $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CardRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return response(['todo index', $request->all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return CardResource
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $card_data = $request->all();
        $card_validator = CardPostValidator::make($card_data);
        $card_validator->validate();

        $card = $this->repository->create($card_data);

        return new CardResource($card);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CardResource
     *
     */
    public function show($id)
    {
        return new CardResource($this->repository->findById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return CardResource
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $card_data = $request->all();
        $card_validator = CardPutValidator::make($card_data, $id);
        $card_validator->validate();

        $card = $this->repository->update($id, $card_data);

        return new CardResource($card);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function destroy($id)
    {
        $this->repository->deleteById($id);
        return response([
            'message' => 'Resource deleted.',
        ], 202);
    }

    /**
     * @OA\Post(
     * path="/cards",
     * summary="Create cards",
     * description="Create cards",
     * tags={"Cards"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Create card",
     *    @OA\JsonContent(
     *       required={"name", "health_points", "expansion_set", "pokemon_type", "card_rarity", "price", "image_url"},
     *       @OA\Property(property="name", type="string", example="dito"),
     *       @OA\Property(property="health_points", type="integer", example="50"),
     *       @OA\Property(property="is_first_edition", type="boolean", example="true"),
     *       @OA\Property(property="is_taken", type="boolean", example="true"),
     *       @OA\Property(property="expansion_set", type="integer", example="1"),
     *       @OA\Property(property="pokemon_type", type="array", @OA\Items(type="integer", example="10")),
     *       @OA\Property(property="card_rarity", type="integer", example="1"),
     *       @OA\Property(property="price", type="number", example="10.50"),
     *       @OA\Property(property="image_url", type="url", format="url", example="www.pokeimage.com/01"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *          ref="#/components/schemas/Card",
     *        )
     *     )
     * )
     */

    /**
     * @OA\Get(
     *     path="/cards/{id}",
     *     tags={"Cards"},
     *     @OA\Parameter(
     *         description="Card ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
     *    @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\JsonContent(
     *          ref="#/components/schemas/Card",
     *      )
     *    )
     * )
     * ),
     */

    /**
     * @OA\Put(
     *     path="/cards/{id}",
     *     summary="Updates a Card",
     *     tags={"Cards"},
     *     @OA\Parameter(
     *         description="Parameter id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Create card",
     *    @OA\JsonContent(
     *       required={"name", "health_points", "expansion_set", "pokemon_type", "card_rarity", "price", "image_url"},
     *       @OA\Property(property="name", type="string", example="dito"),
     *       @OA\Property(property="health_points", type="integer", example="50"),
     *       @OA\Property(property="is_first_edition", type="boolean", example="true"),
     *       @OA\Property(property="is_taken", type="boolean", example="true"),
     *       @OA\Property(property="expansion_set", type="integer", example="1"),
     *       @OA\Property(property="pokemon_type", type="array", @OA\Items(type="integer", example="10")),
     *       @OA\Property(property="card_rarity", type="integer", example="1"),
     *       @OA\Property(property="price", type="number", example="10.50"),
     *       @OA\Property(property="image_url", type="url", format="url", example="www.pokeimage.com/01"),
     *    ),
     * ),
     *     @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\JsonContent(
     *          ref="#/components/schemas/Card",
     *        )
     *      )
     * )
     */

    /**
     * @OA\Delete(
     *     path="/cards/{id}",
     *     tags={"Cards"},
     *     @OA\Parameter(
     *         description="Card ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
     *    @OA\Response(
     *      response=204,
     *      description="Success",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="date", example="Resource deleted"),
     *      )
     *    )
     * )
     * ),
     */
}

