<?php declare(strict_types=1);


namespace Klumba\Repository\Exception;



use Throwable;

class AllReadyExistRepositoryException extends RepositoryException
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $paymentExistsMessage = sprintf('Record with ID: %s is already exists.', $message);
        parent::__construct($paymentExistsMessage, $code, $previous);
    }
}