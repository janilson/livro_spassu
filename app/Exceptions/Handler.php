<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use \Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });

        $this->renderable(function (Throwable $e) {
            return $this->handleException($e);
        });
    }

    public function handleException(Throwable $e)
    {
//        dd($e->getTraceAsString());
        if ($e instanceof AbstractException) {
            $code = $e->getStatusCode();
            $defaultMessage = Response::$statusTexts[$code];
            $message = $e->getMessage() == "" ? $defaultMessage : $e->getMessage();
            return $this->errorResponse($message, $code);
        }

        if ($e instanceof HttpException) {
            $code = $e->getStatusCode();
            $defaultMessage = Response::$statusTexts[$code];
            $message = $e->getMessage() == "" ? $defaultMessage : $e->getMessage();
            return $this->errorResponse($message, $code);
        }

        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $model = strtolower(class_basename($e->getModel()));
            return $this->errorResponse(
                "Does not exist any instance of {$model} with the given id",
                Response::HTTP_NOT_FOUND
            );
        }

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException) {
            return $this->errorResponse('Não autorizado', Response::HTTP_SERVICE_UNAVAILABLE);
        }

        if ($e instanceof \Illuminate\Auth\AuthorizationException) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_FORBIDDEN);
        }

        if ($e instanceof TokenBlacklistedException) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof \Illuminate\Auth\AuthenticationException) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof \Illuminate\Validation\ValidationException) {
            $errors = $this->mountErrors($e->validator->errors()->getMessages());
            return $this->errorResponse($errors, Response::HTTP_FOUND);
        }

        if (config('app.debug')) {
            return $this->dataResponse($e->getMessage());
        } else {
            return $this->errorResponse(
                'Tente novamente mais tarde',
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    /**
     * Data Response
     * @param $data
     * @return JsonResponse
     */
    public function dataResponse($data)
    {
        return response()->json(['message' => $data, 'success' => false, 'code' => Response::HTTP_INTERNAL_SERVER_ERROR]
        );
    }

    /**
     * Success Response
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function successResponse(string $message, $code = Response::HTTP_OK)
    {
        return response()->json(['message' => $message, 'code' => $code], $code);
    }

    /**
     * Error Response
     * @param $message
     * @param int $code
     * @return JsonResponse
     *
     */
    public function errorResponse($message, $code = Response::HTTP_BAD_REQUEST)
    {
        return response()->json(['message' => $message, 'success' => false, 'code' => $code], $code);
    }

    protected function mountErrors(array $errors): string
    {
        $msg = [];
        foreach ($errors as $k => $v) {
            $msg[] = is_array($v) ? implode(';', $v) : $v;
        }

        return implode(';', $msg);
    }
}
