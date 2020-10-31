<?php declare(strict_types=1);


namespace Klumba\Repository;


use Klumba\Domain\Payment;


/**
 * Interface PaymentStorable
 *
 * @package Klumba\Infrastructure
 */
interface PaymentStorable extends Storable
{
    public function add(Payment $entity): bool;
}