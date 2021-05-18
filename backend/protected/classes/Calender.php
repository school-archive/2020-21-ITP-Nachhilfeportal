<?php

namespace classes;

use JsonSerializable;
use PDO;
use PHPUnit\Util\Exception;
use function PHPUnit\Framework\throwException;

require_once __DIR__ . '/../vendor/autoload.php';


class Calender extends User
{
    private $time_from;
    private $time_to;
    private $weekday;
    private $id = 0;

    /**
     * Tutor constructor.
     * @param $email
     * @param $time_from
     * @param $time_to
     * @param $weekday
     */

    public function __construct($email, $time_from, $time_to, $weekday, $id)
    {
        $this->time_from = $time_from;
        $this->time_to = $time_to;
        $this->weekday = $weekday;

    }

    public static function createCalender($email, $time_from, $time_to, $weekday)
    {
        if (Calender::ValidTime($time_from, $time_to) == true) {
            $s = get_np_mysql_object()->
            prepare("insert into calender_free (email, time_from, time_to, weekday) 
        values (:email, :time_from, :time_to, :weekday)");
            $s->bindValue(':email', $email);
            $s->bindValue('time_from', $time_from);
            $s->bindValue(':time_to', $time_to);
            $s->bindValue(':weekday', $weekday);
            $s->execute();
        } else {
            throw new Exception("Illegal Argument");
        }
        return new Calender($email, $time_from, $time_to, $weekday, "");
    }

    public function removeCalender($id)
    {
        $s = get_np_mysql_object()->prepare("delete from calender_free where calender_id = :calender_id");
        $s->execute(array(":calender_id" => $id));
    }

    public static function ValidTime($time_from, $time_to)
    {
        if ($time_from >= $time_to) {
            return false;
        }
        return true;
    }

    public function setWeekday($weekday)
    {
        $this->weekday = $weekday;
    }

    public function settime_from($time_from)
    {
        $this->time_from = $time_from;
    }

    public function settime_to($time_to)
    {
        $this->time_to = $time_to;
    }

    public function getWeekday()
    {
        return $this->weekday;
    }

    /**
     * @return mixed
     */
    public function gettime_from()
    {
        return $this->time_from;
    }

    /**
     * @return mixed
     */
    public function gettime_to()
    {
        return $this->time_to;
    }

    public function __toString()
    {
        return 'weekday = ' . $this->weekday .
            ' time_from = ' . $this->time_from .
            ' time_to = ' . $this->time_to;
    }

    public function jsonSerialize()
    {
        return [
            "weekday" => $this->weekday,
            "time_from" => $this->time_from,
            "time_to" => $this->time_to
        ];
    }
}