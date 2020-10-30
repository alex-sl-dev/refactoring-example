<?php declare(strict_types=1);


namespace Klumba\Repository\Exception;



use Throwable;

class NotFoundRepositoryException extends RepositoryException
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $userNotFoundMessage = sprintf('Record ID: %s is not found.', $message);
        parent::__construct($userNotFoundMessage, $code, $previous);
    }
}