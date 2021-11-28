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
}
