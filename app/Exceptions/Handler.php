<?php

namespace App\Exceptions;

use ErrorException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
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
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Record not found.'
                ], 404);
            }
        });

        $this->renderable(function (Exception $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Record not found.'
                ], 404);
            }
        });
        $this->reportable(function (Throwable $e) {
            // dd($e->getMessage());
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
            
        });

    }
    public function render($request,$exception){
        // dd('sss');
        if ($exception instanceof AuthenticationException) {
            return response()->json(['message' => 'unauthenticated'], 401);
        }
        if ($exception instanceof ValidationException) {
            if ($request->is('api/*')) {
                return response()->json([
                    'errors' => collect($exception->errors())
                ], 422);
            }
        }
        // if ($exception instanceof QueryException || $exception instanceof ErrorException) {
            if ($request->is('api/*')) {
                return response()->json([
                    'errors' => $exception->getMessage()
                ], 500);
            }
        // }

    }


    
}
