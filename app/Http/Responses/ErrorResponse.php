<?php

namespace App\Http\Responses;

use App\Exceptions\PostException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ErrorResponse
{
    public  $httpCode;
    protected $exception;

    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
        $this->httpCode = 500;
    }

    public function toResponse(): ?array
    {
        switch (true){
            case $this->exception instanceof  ModelNotFoundException:
                $this->httpCode = 404;

                return [
                    'success' => false,
                    'error' => [
                        'code' => (string) $this->exception->getCode(),
                        'message' => trans('message.record_not_found'),
                        'details' => [],
                    ],
                ];
            case $this->exception instanceof ValidationException:
                $this->httpCode = 422;

                return [
                    'success' => false,
                    'code' => $this->httpCode,
                    'message' => $this->exception->errors(),
                ];
            case $this->exception instanceof AuthorizationException:
                $this->httpCode = 403;

                return [
                    'success' => false,
                    'code' => $this->httpCode,
                    'message' => $this->exception->getMessage(),
                ];
            case $this->exception instanceof AuthenticationException:
                $this->httpCode = 401;

                return [
                    'success' => false,
                    'code' => $this->httpCode,
                    'message' => $this->exception->getMessage(),
                ];
            case $this->exception instanceof PostException:
                $this->httpCode = $this->exception->getCode();

                return [
                    'success' => false,
                    'code' => $this->exception->getCode(),
                    'message' => $this->exception->getMessage(),
                ];
            case $this->exception instanceof Exception:
                $this->httpCode = $this->exception->getCode() ?: 500;

                return [
                    'success' => false,
                    'code' => $this->httpCode,
                    'message' => $this->exception->getMessage() ?: trans('message.unknown_occurred'),
                ];
            default:
                $this->httpCode = $this->exception->getCode() ?: 500;
                if (true == env('APP_DEBUG')) {
                    return [
                        'success' => false,
                        'error' => [
                            'id' => (string) $this->exception->getCode(),
                            'message' => $this->exception->getMessage(),
                            'details' => [],
                            'exception' => get_class($this->exception),
                            'file' => $this->exception->getFile(),
                            'line' => $this->exception->getLine(),
                            'trace' => $this->exception->getTrace(),
                        ],
                    ];
                }
                return [
                    'success' => false,
                    'error' => [
                        'code' => $this->httpCode,
                        'message' => trans('message.unknown_occurred'),
                        'details' => []
                    ],
                ];
        }
    }
}
