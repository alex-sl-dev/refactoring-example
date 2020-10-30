<?php declare(strict_types=1);


namespace Klumba\Repository;


use Klumba\Domain\Payment;
use Klumba\Repository\Exception\AllReadyExistRepositoryException;


/**
 * Class PaymentStorage
 *
 * @package Klumba\Infrastructure
 */
class PaymentRepository implements Storable
{
    private array $storage = [];

    /**
     * @param Payment $payment
     * @return bool
     * @throws AllReadyExistRepositoryException
     */
    public function add(Payment $payment): bool
    {
        $nextId = 0;

        if (!$payment->getId()) {
            $nextId = $this->defineNextId();
        }

        if (array_key_exists($payment->getId() + $nextId, $this->storage)) {
            throw new AllReadyExistRepositoryException($payment->getId());
        }

        $this->storage[$payment->getId() + $nextId] = $payment;

        return true;
    }

    /**
     * @return int
     */
    private function defineNextId(): int
    {
        return count($this->storage) + 1;
    }
}
