<?php

namespace APP\Data;

Class DatabaseException extends \Exception {
    
    public function DatabaseException($message, $code = 0, \Exception $exception = null)
    {
        parent::__construct($message, $code, $exception);
    }
}