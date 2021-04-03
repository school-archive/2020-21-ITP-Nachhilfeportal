<?php


class Student extends User
{
    private $grade;
    private $department;
    private User $user;

    /**
     * Student constructor.
     * @param $email
     * @param $first_name
     * @param $last_name
     * @param $password
     * @param $picture_url
     * @param $grade
     * @param $department
     * @param int $types
     * @param bool $locked
     */
    public function __construct($email, $first_name, $last_name, $password, $picture_url, $grade, $department, $types = 0, $locked = false)
    {
        $this->user = parent::__construct($email, $first_name, $last_name, $password, $picture_url, $types, $locked);
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