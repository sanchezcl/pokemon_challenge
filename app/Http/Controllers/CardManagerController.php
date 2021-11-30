<?php

namespace App\Http\Controllers;

use App\Http\Resources\CardResource;
use App\Repositories\CardRepositoryInterface;

class CardManagerController extends Controller
{
    /** @var CardRepositoryInterface */
    private $repository;

    /**
     * Create a new controller instance.
     *
     * @param CardRepositoryInterface $repository
     */
    public function __construct(CardRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function takeCard($id)
    {
        $card = $this->repository->takeCard($id);
        return CardResource::make($card);
    }

    public function returnCard($id)
    {
        $card = $this->repository->returnCard($id);
        return CardResource::make($card);
    }

    public function returnAllCards()
    {
        $card = $this->repository->returnAllCards();
        return response([
            'message' => 'Cards returned.',
        ], 202);
    }

    /**
     * @OA\Patch(
     * path="/cards/{id}/take",
     * summary="Manage cards",
     * description="Take cards",
     * tags={"Manage Cards"},
     *     @OA\Parameter(
     *         description="Card ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
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
     * @OA\Patch(
     * path="/cards/{id}/return",
     * summary="Manage cards",
     * description="Return cards",
     * tags={"Manage Cards"},
     *     @OA\Parameter(
     *         description="Card ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
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
     * @OA\Patch(
     * path="/cards/{id}/return_all",
     * summary="Manage cards",
     * description="Return all cards",
     * tags={"Manage Cards"},
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="Cards returned."),
     *        )
     *     )
     * )
     */
}
