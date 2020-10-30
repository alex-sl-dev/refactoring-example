<?php declare(strict_types=1);


namespace Klumba\Domain;


/**
 * Class User is a Domain Model aggregate of some data
 * closely connected with Payment process
 *
 * @package Klumba\Domain
 */
class User
{
    use SerializableDomainTrait;

    private int $id;
    private float $balance;
    private string $email;

    /**
     * User constructor.
     * @param $id
     * @param $balance
     * @param $email
     */
    public function __construct(int $id, float $balance, string $email)
    {
        $this->id = $id;
        $this->balance = $balance;
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param float $amount
     * @return User
     */
    public function updateBalance(float $amount): User
    {
        // domain logic should be defined here
        // otherwise should throw an domain exception

        return new User(
            $this->id,
            $this->balance + $amount,
            $this->email
        );
    }

}
