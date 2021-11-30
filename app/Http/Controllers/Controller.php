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
     *    schema="PageLinks",
     *    @OA\Xml(name="PageLinks"),
     *    @OA\Property(property="first", type="url", example="http://agm.test/cards?page=1"),
     *    @OA\Property(property="last", type="url", example="http://agm.test/cards?page=10"),
     *    @OA\Property(property="prev", type="url", example="null"),
     *    @OA\Property(property="next", type="url", example="http://agm.test/cards?page=2"),
     *)
     */

    /**
     * @OA\Schema(
     *    schema="PageMeta",
     *    @OA\Xml(name="PageLinks"),
     *    @OA\Property(property="current_page", type="integer", example="1"),
     *    @OA\Property(property="from", type="integer", example="1"),
     *    @OA\Property(property="last_page", type="integer", example="10"),
     *    @OA\Property(property="per_page", type="integer", example="5"),
     *    @OA\Property(property="to", type="integer", example="0"),
     *    @OA\Property(property="total", type="integer", example="10"),
     *)
     */

    /**
     *
     */
}
