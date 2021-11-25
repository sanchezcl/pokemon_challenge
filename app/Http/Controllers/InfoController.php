<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Laravel\Lumen\Routing\Router;
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

    public function info()
    {
        return response([
            'app_name' => config('app.name'),
            'framework' => app()->version(),
            'timezone' => config('app.timezone'),
            'current_datetime' => Carbon::now(),
        ], Response::HTTP_OK);
    }

    public function isAlive()
    {
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
