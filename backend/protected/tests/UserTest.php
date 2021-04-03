<?php


use PHPUnit\Framework\TestCase;
require '../classes/User.php';

class UserTest extends TestCase
{


    public function testIsTutor()
    {
        $this->assertInstanceOf(
            User::class,
            new User('email@htl.rennweg.at', 'Lola', 'Lotta', 'password', '../url')
        );
    }

    public function test__construct()
    {
        
    }

    public function testSetLocked()
    {

    }

    public function testGetLocked()
    {

    }

    public function testCreateUser()
    {

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
