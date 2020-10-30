<?php


use Klumba\Domain\User;
use PHPUnit\Framework\TestCase;


/**
 * SHOULD BE CONTINUED :)
 *
 * Class UserTest
 */
class UserTest extends TestCase
{
    protected User $user;

    public function setUp(): void
    {
        $this->user = new User(1, 100, 'foo@bar');
    }

    public function testClassInstantiateCorrectly()
    {
        $expect = [
            'id' => 1,
            'balance' => 100,
            'email' => 'foo@bar'
        ];

        $this->assertEquals($expect, $this->user->toArray(), 'Great construct');
    }

    public function testUserIncreaseBalanceMethod()
    {
        $mutatedUser = $this->user->updateBalance(100);

        $expect = [
            'id' => 1,
            'balance' => 200,
            'email' => 'foo@bar'
        ];

        $this->assertEquals($expect, $mutatedUser->toArray(), 'Great construct');
    }
}