<?php declare(strict_types=1);


namespace Klumba\Services;


use Klumba\Domain\User;
use Klumba\Repository\Exception\NotFoundRepositoryException;
use Klumba\Repository\UserRepository;


/**
 * Class UserService
 * @package Klumba\Services
 */
class UserService
{
    protected UserRepository $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     * @param float $amount
     * @return bool
     * @throws NotFoundRepositoryException
     */
    public function changeBalance(User $user, float $amount): bool
    {
        return $this->userRepository->update($user->updateBalance($amount));
    }
}