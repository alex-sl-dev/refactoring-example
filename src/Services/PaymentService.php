<?php declare(strict_types=1);


namespace Klumba\Services;


use Klumba\Domain\Payment;
use Klumba\Domain\User;
use Klumba\Repository\Exception\AllReadyExistRepositoryException;
use Klumba\Repository\PaymentRepository;
use Klumba\Repository\PaymentStorable;


class PaymentService
{

    protected PaymentStorable $paymentRepository;

    /**
     * PaymentService constructor.
     *
     * @param PaymentStorable $paymentRepository
     */
    public function __construct(PaymentStorable $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * @param User $user
     * @param float $amount
     * @return bool
     * @throws AllReadyExistRepositoryException
     */
    public function changeBalance(User $user, float $amount): bool
    {
        return $this->paymentRepository->add(new Payment(0, $user, $amount));
    }

}
