<?php

namespace classes;

use JsonSerializable;
use PDO;

require_once __DIR__ . '/../vendor/autoload.php';


class Calender
{
    private $timefrom;
    private $timeto;
    private $weekday;
    private $id;

    /**
     * Tutor constructor.
     * @param $email
     * @param $timefrom
     * @param $timeto
     * @param $weekday
     */

    public function __construct($email, $timefrom, $timeto, $weekday)
    {
        $this->timefrom = $timefrom;
        $this->timeto = $timeto;
        $this->weekday = $weekday;

    }

    public static function array_sort($array, $on)
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

    public static function createCalender($email, $timefrom, $timeto, $weekday)
    {
        $s = get_np_mysql_object()->
        prepare("insert into calender_free (email, timefrom, timeto, weekday) 
        values (:email, :timefrom, :timeto, :weekday)");
        $s->bindValue(':email', $email);
        $s->bindValue('timefrom', $timefrom);
        $s->bindValue(':timeto', $timeto);
        $s->bindValue(':weekday', $weekday);
        $s->execute();

        return new Calender($email, $timefrom, $timeto, $weekday);
    }


    public function setWeekday($weekday)
    {
        $this->weekday = $weekday;
    }

    public function setTimefrom($timefrom)
    {
        $this->timefrom = $timefrom;
    }

    public function setTimeto($timeto)
    {
        $this->timeto = $timeto;
    }

    public function getWeekday()
    {
        return $this->weekday;
    }

    /**
     * @return mixed
     */
    public function getTimefrom()
    {
        return $this->timefrom;
    }

    /**
     * @return mixed
     */
    public function getTimeto()
    {
        return $this->timeto;
    }

    public function toArray()
    {
        return array(
            'weekday' => $this->weekday,
            'timefrom' => $this->timefrom,
            'timeto' => $this->timeto
        );
    }

    public function toString()
    {
        return 'weekday = ' . $this->weekday .
            ' timefrom = ' . $this->timefrom .
            ' timeto = ' . $this->timeto;
    }
}