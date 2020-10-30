<?php declare(strict_types=1);


namespace Klumba\Repository\Exception;


use Exception;
use Throwable;


class RepositoryException extends Exception
{

    /**
     * Construct the exception. Note: The message is NOT binary safe.
     * @link https://php.net/manual/en/exception.construct.php
     * @param string $message [optional] The Exception message to throw.
     * @param int $code [optional] The Exception code.
     * @param Throwable $previous [optional] The previous throwable used for the exception chaining.
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null) {

        error_log($message);

        parent::__construct($message, 123, $previous);
    }
}