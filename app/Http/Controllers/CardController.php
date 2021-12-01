<?php

namespace App\Http\Controllers;

use App\Http\Resources\CardResourceCollection;
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

    const RESOURCE_DELETED_MESSAGE = 'Resource deleted.';
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
     * @return CardResourceCollection
     */
    public function index(Request $request)
    {
        $queries = [
            'filters' => $request->get('filter'),
            'sorts' => $request->get('sort'),
            'page' => $request->get('page'),
        ];
        $cards = $this->repository->findAll($queries);
        return new CardResourceCollection($cards);
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
            'message' => self::RESOURCE_DELETED_MESSAGE,
        ], 202);
    }
}

/**
 * @OA\Get(
 *     path="/cards",
 *     tags={"Cards"},
 *     @OA\Parameter(
 *        description="Query filters: pokemon name",
 *        in="query",
 *        name="filter[name]",
 *        example="charizard",
 *        @OA\Schema(
 *           type="string",
 *        )
 *     ),
 *     @OA\Parameter(
 *        description="Query filters: if is taken (0 = false, 1 = true)",
 *        in="query",
 *        name="filter[is_taken]",
 *        example=0,
 *        @OA\Schema(
 *           type="string",
 *        )
 *     ),
 *     @OA\Parameter(
 *        description="Query filters: espansion set name",
 *        in="query",
 *        name="filter[expansionSet]",
 *        example="base set 2",
 *        @OA\Schema(
 *           type="string",
 *        )
 *     ),
 *     @OA\Parameter(
 *        description="Query filters: pokemon type",
 *        in="query",
 *        name="filter[pokemonTypes]",
 *        example="fire",
 *        @OA\Schema(
 *           type="string",
 *        )
 *     ),
 *     @OA\Parameter(
 *        description="Sorts: separated with commas and colon to set the direction, with no direction default is asc. Sorts alowed name, health_points, price, is_first_edition, is_taken",
 *        in="query",
 *        name="sort",
 *        example="name,price:desc,is_taken:asc",
 *        @OA\Schema(
 *           type="string",
 *        )
 *     ),
 *     @OA\Parameter(
 *        description="Page",
 *        in="query",
 *        name="page",
 *        example="1",
 *        @OA\Schema(
 *           type="integer",
 *        )
 *     ),
 *     @OA\Response(
 *      response=200,
 *      description="Success",
 *    @OA\JsonContent(
 *          @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Card")),
 *          @OA\Property(property="links", type="array", @OA\Items(ref="#/components/schemas/PageLinks")
 *          ),
 *        )
 *     )
 *    )
 * )
 */

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
 *          ref="#/components/schemas/CardRequest",
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
 *          ref="#/components/schemas/CardRequest",
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

/**
 * @OA\Schema(
 * @OA\Xml(name="CardRequest"),
 *       schema="CardRequest",
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
 * )
 */
