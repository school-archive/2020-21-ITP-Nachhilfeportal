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

    function array_sort($array, $on)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }
            asort($sortable_array);
            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }
        return $new_array;
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

    public function toArray()
    {
        return array(
            'weekday' => $this->weekday,
            'timeFrom' => $this->from,
            'timeto' => $this->to

        );
    }
}