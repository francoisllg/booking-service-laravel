<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use App\Traits\Http\Controllers\Api\ApiResponserTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class Handler extends ExceptionHandler
{
    use ApiResponserTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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
            //
        });
    }

    public function render($request, Throwable $exception)
    {
      if($exception instanceof ValidationException){
        return $this->convertValidationExceptionToResponse($exception, $request);
      }

      if($exception instanceof AuthorizationException){
        $exception->getMessage() ? $message = $exception->getMessage() : $message = 'This action is unauthorized';
        $exception->getCode() ? $code = $exception->getCode() : $code = Response::HTTP_UNAUTHORIZED;
        return $this->errorResponse($message, $code);
      }

      if ($exception instanceof ModelNotFoundException){
        $model = strtolower(class_basename($exception->getModel()));
        $message = "Does not exists any {$model} with the specified identificator";
        return $this->errorResponse($message, 404);
      }

      if($exception instanceof NotFoundHttpException){
        $message = 'The specified URL cannot be found';
        return $this->errorResponse($message, Response::HTTP_NOT_FOUND);
      }

      if($exception instanceof MethodNotAllowedException){
        $message = 'The specified method for the request is invalid';
        return $this->errorResponse($message, Response::HTTP_METHOD_NOT_ALLOWED);
      }

      return parent::render($request, $exception);
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request){
        $errors = $e->validator->errors()->getMessages();
        return $this->errorResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
