<?php declare(strict_types=1);


namespace Klumba\Services;


use Klumba\Domain\User;

class MailService
{

    /**
     * @param User $user
     * @return bool
     */
    public function sendEmail(User $user)
    {
        // @TODO
        // better to define some useful Mail Class
        // for consistency and reusing purposes

        $adminEmail = 'admin@test.com';

        $subject = 'Balance update';

        $message = 'Hello! Your balance has been successfully updated!';

        $headers = 'From: ' . $adminEmail . "\r\n" .
            'Reply-To: ' . $adminEmail . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($user->getEmail(), $subject, $message, $headers);

        return true;
    }
}