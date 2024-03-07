<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class SaleCanceledError extends Exception implements Throwable
{

    protected $message = 'Sale does not can be canceled';

    public function __construct($message , Throwable $previous = null, int $code = 0, array $headers = [])
    {
        if (empty($message)) {
            $message = $this->message;
        }

        parent::__construct($message, $code, $previous);
    }
}
