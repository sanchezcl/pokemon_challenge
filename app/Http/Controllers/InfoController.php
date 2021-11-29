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
     *     tags={"App info"},
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
     *     tags={"App info"},
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

}
