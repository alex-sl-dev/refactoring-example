<?php declare(strict_types=1);


namespace Klumba\Services;


use Exception;
use Klumba\Domain\User;
use Klumba\Services\Exception\PaymentProcessException;

class PaymentProcessorService
{
    protected UserService $userService;
    protected PaymentService $paymentService;
    protected MailService $mailService;

    public function __construct(
        UserService $userService,
        PaymentService $paymentService,
        MailService $mailService
    )
    {
        $this->userService = $userService;
        $this->paymentService = $paymentService;
        $this->mailService = $mailService;
    }

    /**
     * Maybe can grows to some composition like Chain Of Responsibility
     *
     * @param User $user
     * @param $amount
     * @throws PaymentProcessException
     */
    public function processPayment(User $user, $amount)
    {
        try {
            // for first
            // we try to update balance for user
            // usually it can contain some business logic
            if ($this->userService->changeBalance($user, $amount)) {
                // then update depend entities, store this record in payments repository
                $this->paymentService->changeBalance($user, $amount);
                // also send an email
                $this->mailService->sendEmail($user);
            }
        } catch (Exception $e) {
            throw new PaymentProcessException('Failed to pop up user balance');
        }
    }

}