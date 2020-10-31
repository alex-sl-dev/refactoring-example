<?php declare(strict_types=1);


namespace Klumba\Services;


use Klumba\Domain\User;
use Klumba\Repository\Exception\NotFoundRepositoryException;
use Klumba\Repository\UserRepository;
use Klumba\Repository\UserStorable;


/**
 * Class UserService
 * @package Klumba\Services
 */
class UserService
{
    protected UserStorable $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserStorable $userRepository
     */
    public function __construct(UserStorable $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     * @param float $amount
     * @return bool
     */
    public function changeBalance(User $user, float $amount): bool
    {
        return $this->userRepository->update($user->updateBalance($amount));
    }
}