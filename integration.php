<?php declare(strict_types=1);

use Klumba\Domain\User;
use Klumba\Repository\Exception\AllReadyExistRepositoryException;
use Klumba\Repository\PaymentRepository;
use Klumba\Repository\UserRepository;
use Klumba\Services\MailService;
use Klumba\Services\PaymentProcessorService;
use Klumba\Services\PaymentService;
use Klumba\Services\UserService;

require_once 'vendor/autoload.php';

$container = new League\Container\Container;

$container->add(MailService::class);

$container->add(UserRepository::class, null, true);
$container->add(PaymentRepository::class, null, true);

$container->add(UserService::class)->addArgument(UserRepository::class);
$container->add(PaymentService::class)->addArgument(PaymentRepository::class);

$container->add(PaymentProcessorService::class)->addArguments([
    UserService::class,
    PaymentService::class,
    MailService::class
]);

/** @var PaymentProcessorService $paymentProcessor */
$paymentProcessor = $container->get(PaymentProcessorService::class);

$testData = require_once 'test-data.php';

foreach ($testData as $testDataRow) {

    list($user, $amount) = $testDataRow;

    $userModel = new User($user['id'], $user['balance'], $user['email']);

    /** @var UserRepository $userRepository */
    $userRepository = $container->get(UserRepository::class);
    // fix test case
    $userRepository->add($userModel);

    try {
        $paymentProcessor->processPayment($userModel, $amount);

        $expectedBalance = $user['balance'] + $amount;

        $validateUserModel = $userRepository->get($userModel->getId());

        $info = sprintf('User balance should be updated %s: %s', $expectedBalance, $validateUserModel->getBalance());

        $result = assert($expectedBalance === $validateUserModel->getBalance(), $info);
    } catch (\Exception $e) {
        $result = false;

        $info = sprintf('User balance should be updated, exception: %s', $e->getMessage());
    }

    echo sprintf("[%s] %s\n", $result ? 'SUCCESS' : 'FAIL', $info);
}