<?php


use classes\Subject;
use PHPUnit\Framework\TestCase;

class SubjectTest extends TestCase
{

    public function test__construct()
    {

    }

    public function testCreateSubject()
    {
        $subject = Subject::createSubject('email15@htl.rennweg.at', 'INSY2', '000', 3);

        $this->assertInstanceOf(
            Subject::class,
            $subject
        );

        return $subject;
    }

    /**
     * @depends testCreateSubject
     * @param $subject
     */
    public function testSetMETrue($subject)
    {
        $subject->setME(true);
        $this->assertEquals(4, $subject->getDepartment());
    }

    public function testSetMETrue2()
    {
        $subject = Subject::getSubject('WIR');
        $subject->setME(true);
        $this->assertEquals(4, $subject->getDepartment());
    }

    public function testSetMEFalse()
    {
        $subject = Subject::getSubject('INSY1');
        $subject->setME(false);
        $this->assertEquals('000', $subject->getDepartment());
    }

    public function testSetITTrue()
    {
        $subject = Subject::getSubject('WIR');
//        $b = $subject->setIT(true);
        $this->assertEquals(6, $subject->getDepartment());
    }

    public function testSetITFalse()
    {
        $subject = Subject::getSubject('WIR4');
        $bool = $subject->setIT(false);
        $this->assertEquals(4, $subject->getDepartment());
    }

    public function testDeleteSubject()
    {

    }

    public function testGet_subjects()
    {

    }
}
