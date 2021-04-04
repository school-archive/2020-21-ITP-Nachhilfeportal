<?php
require '../vendor/autoload.php';

use classes\User;
use PHPUnit\Framework\TestCase;


class UserTest extends TestCase
{

    public function test__construct()
    {
        $this->assertInstanceOf(
            User::class,
            new User('email@htl.rennweg.at', 'Lola', 'Lotta', 'password', '../url')
        );
    }

    public function testSetLocked()
    {

    }

    public function testGetLocked()
    {

    }

    public function testCreateUser()
    {
        $this->assertInstanceOf(
            User::class,
            User::createUser('email3@htl.rennweg.at', 'Lola', 'Lotta', 'password', '../url')
        );
    }

    public function testStudent()
    {

    }

    public function testGetPictureUrl()
    {

    }

    public function testSetTutor()
    {

    }

    public function testGetFirstName()
    {

    }

    public function testGetLastName()
    {

    }

    public function testDeleteUser()
    {

    }

    public function testJsonSerialize()
    {

    }

    public function testIsAdmin()
    {

    }

    public function testIsTutor()
    {

    }

    public function testGetEmail()
    {

    }

    public function testGetUser()
    {

    }

    public function testGetPassword()
    {

    }

    public function testSetAdmin()
    {

    }
}
