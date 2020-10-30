<?php


namespace Klumba\Services\Exception;


use Exception;
use Throwable;

class PaymentProcessException extends Exception
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {

        error_log($message);

        parent::__construct($message, $code, $previous);
    }
}