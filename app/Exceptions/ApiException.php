<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ApiException extends Exception
{
    public $extra;
    
    public function __construct($error = 'Internal Error', $statusCode = 500, $extra = [], Throwable $previous = null)
    {
        parent::__construct($error, $statusCode, $previous);
        $this->extra = $extra;
    }
}
