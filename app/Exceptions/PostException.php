<?php

namespace App\Exceptions;

use Exception;

class PostException extends Exception
{
    //use Exception;
    public function __construct(string $message = "", int $code = 400, ?\Throwable $previous = null)
    {
        parent::__construct();
        // set custom message
        $this->message = $message ?: __('messages.post_not_found');
        $this->code = $code ?: $this->code;
    }
}
