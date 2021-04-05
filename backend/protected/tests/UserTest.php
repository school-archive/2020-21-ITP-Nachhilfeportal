<?php
require '../vendor/autoload.php';

use classes\User;
use PHPUnit\Framework\TestCase;


class UserTest extends TestCase
{

    public function test__construct()
    {
        $user = new User('email@htl.rennweg.at', 'Lola', 'Lotta', 'password', '../url');
        $this->assertInstanceOf(
            User::class,
            $user
        );

        return $user;
    }

    public function testCreateUser()
    {
        $user =  User::createUser('email14@htl.rennweg.at', 'Lola', 'Lotta', 'password', '../url');
        $this->assertInstanceOf(
            User::class,
           $user
        );

        return $user->getEmail();
    }

    /**
     * @depends testCreateUser
     * @param $email
     */
    public function testCreateUser_alreadyExists($email)
    {
        $this->assertFalse(
            User::createUser($email, 'Lola', 'Lotta', 'password', '../url')
        );
    }

    /**
     * @depends testCreateUser
     * @param $email
     */
    public function testGetUser_validEmail($email)
    {
        $this->assertInstanceOf(
            User::class,
            User::getUser($email)
        );
    }

    public function testGetUser_invalidEmail()
    {
        $this->assertFalse(
            User::getUser('not_an_existing_email')
        );
    }

    public function testDeleteUser()
    {

    }

    /**
     * @depends test__construct
     * @param $user
     */
    public function testGetLocked($user)
    {
        $this->assertFalse(
            $user->getLocked()
        );
    }

    public function testSetLocked()
    {

    }

    public function testStudent()
    {

    }

    public function testSetAdmin()
    {

    }

    public function testIsAdmin()
    {

    }

    public function testSetTutor()
    {

    }

    public function testIsTutor()
    {

    }

}
