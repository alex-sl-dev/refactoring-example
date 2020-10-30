<?php declare(strict_types=1);


namespace Klumba\Domain;

use DomainException;

/**
 * Class Payment an domain model that allow collect history about payment flow
 *
 * @package Klumba\Domain
 */
class Payment
{
    use SerializableDomainTrait;

    private int $id;
    private int $userId;
    private string $type;
    private float $balanceBefore;
    private float $amount;

    /**
     * Payment constructor.
     *
     * @param int $id
     * @param User $user
     * @param float $amount
     */
    public function __construct(int $id, User $user, float $amount)
    {
        $this->id = $id;
        $this->userId = $user->getId();
        $this->balanceBefore = $user->getBalance();
        $this->amount = $amount;

        $this->setType();
    }

    /**
     * Helper method for define type by amount
     */
    private function setType(): void
    {
        if (!$this->amount)
            throw new DomainException('Can\'n define payment type by amount');

        $this->type = $this->amount >= 0 ? 'in' : 'out';
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}