<?php

namespace classes;

use JsonSerializable;
use PDO;
use PHPUnit\Util\Exception;
use function PHPUnit\Framework\throwException;

require_once __DIR__ . '/../vendor/autoload.php';


class Calender
{
    private $timefrom;
    private $timeto;
    private $weekday;
    private $id = 0;

    /**
     * Tutor constructor.
     * @param $email
     * @param $timefrom
     * @param $timeto
     * @param $weekday
     */

    public function __construct($email, $timefrom, $timeto, $weekday, $id)
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
        if (Calender::ValidTime($timefrom, $timeto) == true) {
            $s = get_np_mysql_object()->
            prepare("insert into calender_free (email, timefrom, timeto, weekday) 
        values (:email, :timefrom, :timeto, :weekday)");
            $s->bindValue(':email', $email);
            $s->bindValue('timefrom', $timefrom);
            $s->bindValue(':timeto', $timeto);
            $s->bindValue(':weekday', $weekday);
            $s->execute();

            $s = get_np_mysql_object()->prepare("select * from calender_free where email = :email");
            $s->execute(array(":email" => $email));
            $obj = $s->fetch();
        } else {
            throw new Exception("Illegal Argument");
        }
        return new Calender($email, $timefrom, $timeto, $weekday, $obj['id']);
    }

    public function removeCalender($id)
    {
        $s = get_np_mysql_object()->prepare("delete from calender_free where id = :id");
        $s->execute(array(":email" => $this->email));
    }

    public function timeonDay($weekday)
    {
        $s = get_np_mysql_object()->prepare("select timefrom from calender_free where weekday = :weekday");
        $s->execute(array(":email" => $this->email));
        $obj = $s->fetch();
        return new Calender();
    }

    public static function ValidTime($timefrom, $timeto)
    {
        if ($timefrom >= $timeto) {
            return false;
        }
        return true;
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