<?php

namespace classes;

use PHPUnit\Framework\TestCase;

class TutorTest extends TestCase
{
    public function test__construct()
    {
        $tutor = new Tutor('email@htl.rennweg.at', 'Lola', 'Lotta', 'password', '../url', 'Desc', 2, 4, 'IT');
        $this->assertInstanceOf(Tutor::class, $tutor);
        return $tutor;
    }

    /**
     * @depends test__construct
     * @param Tutor $tutor
     */
    public function testIsTM_online(Tutor $tutor)
    {
        $this->assertTrue(
            $tutor->isTM_online()
        );
    }

    /**
     * @depends test__construct
     * @param Tutor $tutor
     */
    public function testIsTM_present(Tutor $tutor)
    {
        $this->assertFalse(
            $tutor->isTM_present()
        );
    }
}
