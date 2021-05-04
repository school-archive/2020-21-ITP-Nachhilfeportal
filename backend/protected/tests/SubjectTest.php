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
        $subject = Subject::createSubject('email15@htl.rennweg.at', 'Medt', '000', 3);

        $this->assertInstanceOf(
            Subject::class,
            $subject
        );

        return $subject;
    }

    public function testGetSubject()
    {
        $subject = Subject::getSubject('Medt');
        $this->assertEquals(0, $subject->getDepartment());
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
        $subject = Subject::getSubject('Medt');
        $subject->setME(true);
        $this->assertEquals(4, $subject->getDepartment());
    }

    public function testSetMEFalse()
    {
        $subject = Subject::getSubject('Medt');
        $subject->setME(false);
        $this->assertEquals('000', $subject->getDepartment());
    }

    public function testSetITTrue()
    {
        $subject = Subject::getSubject('Medt');
        $subject->setIT(true);
        $this->assertEquals(7, $subject->getDepartment());
    }

    public function testSetITFalse()
    {
        $subject = Subject::getSubject('Medt');
        $subject->setIT(false);
        $this->assertEquals(5, $subject->getDepartment());
    }

    public function testSetFSTrue()
    {
        $subject = Subject::getSubject('Medt');
        $subject->setFS(true);
        $this->assertEquals(7, $subject->getDepartment());
    }

    public function testSetFSFalse()
    {
        $subject = Subject::getSubject('Medt');
        $subject->setFS(false);
        $this->assertEquals(6, $subject->getDepartment());
    }

    public function testDeleteSubject()
    {

    }

    public function testGet_subjects()
    {

    }
}
