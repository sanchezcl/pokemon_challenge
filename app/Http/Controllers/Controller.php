<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *   title="Agree Challenge",
     *   version="1.0",
     *   description="This API is an Agree's challege.",
     *   @OA\Contact(
     *     email="ydobon@tset.test",
     *     name="Developer"
     *   )
     * )
     */

    /**
     *     @OA\Schema(
     *         schema="enumJson",
     *         @OA\Xml(name="InfoData"),
     *         @OA\Property(property="id", type="integer", example="1"),
     *         @OA\Property(property="name", type="string", example="item name"),
     *     )
     */


    /**
     * @OA\Schema(
     *    schema="InfoData",
     *    @OA\Xml(name="InfoData"),
     *    @OA\Property(property="app_name", type="string", example="app name"),
     *    @OA\Property(property="framework", type="string", example="Lumen (8.3.1) (Laravel Components ^8.0)"),
     *    @OA\Property(property="timezone", type="string", example="UTC"),
     *    @OA\Property(property="current_datetime", type="datetime", example="2021-11-25T23:19:09.814204Z"),
     *)
     */

    /**
     * @OA\Schema(
     * @OA\Xml(name="Card"),
     *       schema="Card",
     *       @OA\Property(property="name", type="string", example="dito"),
     *       @OA\Property(property="health_points", type="integer", example="50"),
     *       @OA\Property(property="is_first_edition", type="boolean", example="true"),
     *       @OA\Property(property="is_taken", type="boolean", example="true"),
     *       @OA\Property(property="expansion_set", type="integer", example="1"),
     *       @OA\Property(property="pokemon_type", type="array", @OA\Items(type="string", example="Fire"),),
     *       @OA\Property(property="card_rarity", type="integer", example="1"),
     *       @OA\Property(property="price", type="number", example="10.50"),
     *       @OA\Property(property="image_url", type="url", format="url", example="www.pokeimage.com/01"),
     *       @OA\Property(property="created_at", type="date", example="2021-11-29"),
     * )
     */
}
