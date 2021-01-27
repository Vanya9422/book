<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [//
    ];
    
    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];
    
    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }
    
    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->is('auth', 'auth/*', 'api', 'api/*')) {
            $response = function ($content, $status) use ($exception) {
                $response = response(array_merge($content, config('app.debug') ? [
                    'class' => get_class($exception),
                    'message' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'trace' => $exception->getTrace(),
                ] : []), $status);
                
                $response->exception = $exception;
                
                return $response;
            };
            
            if ($exception instanceof AuthenticationException) {
                return $response(['error' => 'Unauthenticated'], 401);
            }
            
            if ($exception instanceof ModelNotFoundException) {
                return $response(['error' => 'Not Found'], 404);
            }
            
            if ($exception instanceof TokenMismatchException) {
                return $response(['error' => 'CSRF Token Mismatch'], 403);
            }
            
            if ($exception instanceof ValidationException) {
                return $response([
                    'error' => 'Validation',
                    'validation_fields' => $exception->validator->errors(),
                ], 422);
            }
            
            if ($exception instanceof ApiException) {
                return $response(array_merge([
                    'error' => $exception->getMessage(),
                ], $exception->extra), $exception->getCode());
            }
            
            if (method_exists($exception, 'getStatusCode')) {
                if ($exception->getStatusCode() === 401) {
                    return $response(['error' => 'Unauthenticated'], 401);
                }
                
                if ($exception->getStatusCode() === 403) {
                    return $response(['error' => 'Forbidden'], 403);
                }
                
                if ($exception->getStatusCode() === 404) {
                    return $response(['error' => 'Not Found'], 404);
                }
            }
            
            return $response(['error' => 'Internal Error'], 500);
        }
        
        if ($exception instanceof ModelNotFoundException) {
            return app('router')->jumpToRoute('main.not_found');
        }
        
        return parent::render($request, $exception);
    }
}
