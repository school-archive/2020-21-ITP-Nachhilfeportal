<?php

abstract class Tutor extends User
{
    private $description;
    private $teaching_method;

    /**
     * Tutor constructor.
     * @param $description
     * @param $teaching_method
     */
    public function __construct($description, $teaching_method)
    {
        $this->description = $description;
        $this->teaching_method = $teaching_method;
    }

    public function getDescription()
    {
        return $this->description;
    }


    public function getTeaching_method()
    {
        return $this->teaching_method;
    }

}