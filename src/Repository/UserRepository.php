<?php declare(strict_types=1);


namespace Klumba\Repository;


use Klumba\Domain\User;
use Klumba\Repository\Exception\AllReadyExistRepositoryException;
use Klumba\Repository\Exception\NotFoundRepositoryException;

/**
 * Class UserRepository
 *
 * @package Klumba\Repository
 */
class UserRepository implements UserStorable
{
    private array $storage = [];

    /**
     * Update an user in collection
     *
     * @param User $user
     * @return bool
     * @throws NotFoundRepositoryException
     */
    public function update(User $user): bool
    {
        if (array_key_exists($user->getId(), $this->storage)) {
            $this->storage[$user->getId()] = $user;

            return true;
        }

        throw new NotFoundRepositoryException($user->getId());
    }

    /**
     * @param User $user
     * @return bool
     * @throws AllReadyExistRepositoryException
     */
    public function add(User $user): bool
    {
        if (array_key_exists($user->getId(), $this->storage)) {
            throw new AllReadyExistRepositoryException();
        }

        $this->storage[$user->getId()] = $user;

        return true;
    }

    /**
     * @param int $id
     * @return User
     * @throws NotFoundRepositoryException
     */
    public function get(int $id): User
    {
        if (!array_key_exists($id, $this->storage)) {
            throw new NotFoundRepositoryException();
        }

        return $this->storage[$id];
    }
}
