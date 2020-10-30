<?php declare(strict_types=1);


namespace Klumba\Services;


use Klumba\Domain\Payment;
use Klumba\Domain\User;
use Klumba\Repository\Exception\AllReadyExistRepositoryException;
use Klumba\Repository\PaymentRepository;


class PaymentService
{

    protected PaymentRepository $paymentRepository;

    /**
     * PaymentService constructor.
     *
     * @param PaymentRepository $paymentRepository
     */
    public function __construct(PaymentRepository $paymentRepository)
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
