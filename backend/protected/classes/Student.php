<?php


class Student extends User
{
    private $grade;
    private $department;

    /**
     * Student constructor.
     * @param $email
     * @param $first_name
     * @param $last_name
     * @param $password
     * @param $picture_url
     * @param $grade
     * @param $department
     */
    public function __construct($email, $first_name, $last_name, $password, $picture_url, $grade, $department)
    {
        parent::__construct($email, $first_name, $last_name, $password, $picture_url, $types);
        $this->grade = $grade;
        $this->department = $department;
    }


    /**
     * @return mixed
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param mixed $grade
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    /**
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param mixed $department
     */
    public function setDepartment($department)
    {
        $this->department = $department;
    }

}