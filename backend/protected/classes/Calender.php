<?php

namespace classes;

use JsonSerializable;
use PDO;

require_once __DIR__ . '/../vendor/autoload.php';


class Calender
{
    private $from;
    private $to;
    private $weekday;

    /**
     * Tutor constructor.
     * @param $email
     * @param $first_name
     * @param $last_name
     * @param $password
     * @param $picture_url
     * @param $from
     * @param $to
     * @param $weekday
     * @param int $types
     * @param false $locked
     */

    public function __construct($email, $first_name, $last_name, $password, $picture_url, $from, $to, $weekday, $grade, $department, $types = 0, $locked = false)
    {
        parent::__construct($email, $first_name, $last_name, $password, $picture_url, $grade, $department, $types, $locked);
        $this->from = $from;
        $this->to = $to;
        $this->weekday = $weekday;

    }

    public function setWeekday($weekday)
    {
        $this->weekday = $weekday;
    }

    public function setTimeFROM($from)
    {
        $this->from = $from;
    }

    public function setTimeTO($to)
    {
        $this->to = $to;
    }

    public function getTimeFROM()
    {
        return from;
    }

    public function getTimeTO()
    {
        return to;
    }

    public function getWeekday()
    {
        return weekday;
    }
}