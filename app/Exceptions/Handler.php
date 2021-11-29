<?php

namespace App\Exceptions;

use App\Http\Resources\ErrorResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $status_code = $this->getDefaultStatus($exception);
        $message = null;
        $extraMessage = null;

        if ($exception instanceof HttpResponseException) {
            $status_code = Response::HTTP_INTERNAL_SERVER_ERROR;
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            $status_code = Response::HTTP_METHOD_NOT_ALLOWED;
        } elseif ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
            $status_code = Response::HTTP_NOT_FOUND;
            $message = 'resource ' . $this->getNotFoundMessage($exception) . ' not found';
        } elseif ($exception instanceof AuthorizationException) {
            $status_code = Response::HTTP_FORBIDDEN;
            $message = 'Forbidden';
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            $message = 'Method not allow';
        } elseif ($exception instanceof ValidationException) {
            $message = $exception->validator->getMessageBag();
        } elseif ($exception instanceof \PDOException || $exception instanceof QueryException) {
            $message = 'internal error';
            $status_code = Response::HTTP_INTERNAL_SERVER_ERROR;
            $extraMessage = $exception->getMessage();
        }

        $structure = $this->getBaseStructure($exception, $status_code, $message, $extraMessage);
        if (method_exists($exception, 'errors')) {
            $status_code = Response::HTTP_UNPROCESSABLE_ENTITY;
        }
        return response()->json($structure, $status_code);
    }

    protected function getNotFoundMessage($exception)
    {
        $message = str_replace(['[', ']'], '', $exception->getMessage());
        $model = explode('\\', $message);
        return $model[count($model) - 1];
    }

    protected function getDefaultStatus(Throwable $e)
    {
        $code = $e->getCode();
        return $code > 100 && $code < 600 ? $code : Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    public function getBaseStructure(Throwable $e, $status, $message = null, $extraMessage = null)
    {
        $debug = null;
        if (config('app.debug')) {
            $debug = [
                'extraMessage' => $extraMessage,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ];
        }
        return (new ErrorResource([
            'status' => 'error',
            'error_code' => $status,
            'message' => $message ?? $e->getMessage(),
            'debug' => $debug,
        ]));
    }
}
