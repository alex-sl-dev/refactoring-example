<?php declare(strict_types=1);


namespace Klumba\Repository;


use Klumba\Domain\User;

/**
 * Interface UserStorable
 *
 * @package Klumba\Infrastructure
 */
interface UserStorable extends Storable
{
    public function update(User $entity): bool;

    public function add(User $entity): bool;

    public function get(int $id): User;
}