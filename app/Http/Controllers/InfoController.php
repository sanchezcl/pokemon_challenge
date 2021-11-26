<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class InfoController extends Controller
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
     *     path="/",
     *     operationId="/",
     *     tags={"app info"},
     *     @OA\Response(
     *         response="200",
     *         description="Returns basic app info",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/InfoData")
     *         ),
     *     ),
     *
     * )
     */
    public function info()
    {
        return response([
            'app_name' => config('app.name'),
            'framework' => app()->version(),
            'timezone' => config('app.timezone'),
            'current_datetime' => Carbon::now(),
        ], Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/is_alive",
     *     operationId="/is_alive",
     *     tags={"app info"},
     *     @OA\Response(
     *         response="204",
     *         description="check if the app is alive",
     *     ),
     *     @OA\Response(
     *         response=504,
     *         description="Server not available"
     *     ),
     * ),
     */
    public function isAlive()
    {
        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @OA\Components(
     *     @OA\Schema(
     *         schema="InfoData",
     *         @OA\Xml(name="InfoData"),
     *         @OA\Property(property="app_name", type="string", example="app name"),
     *         @OA\Property(property="framework", type="string", example="Lumen (8.3.1) (Laravel Components ^8.0)"),
     *         @OA\Property(property="timezone", type="string", example="UTC"),
     *         @OA\Property(property="current_datetime", type="datetime", example="2021-11-25T23:19:09.814204Z"),
     *     )
     * )
     */
}
