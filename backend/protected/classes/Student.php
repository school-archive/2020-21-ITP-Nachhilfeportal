<?php


abstract class Student extends User
{
    private $grade;
    private $department;

    /**
     * Student constructor.
     * @param $grade
     * @param $department
     */
    public function __construct($grade, $department)
    {
        $this->grade = $grade;
        $this->department = $department;
    }


}