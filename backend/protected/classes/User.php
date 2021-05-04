<?php

namespace classes;

use JsonSerializable;
use PDO;

require_once __DIR__ . '/../vendor/autoload.php';

class User implements JsonSerializable
{

    private $email;
    private $first_name;
    private $last_name;
    private $password;
    private $picture_url;
    private $grade;
    private $department;
    private $isAdmin;
    private $locked;
    private $calender;
    private $subjects;



    /***
     * User constructor.
     * @param $email
     * @param $first_name
     * @param $last_name
     * @param $password
     * @param $picture_url
     * @param null $grade
     * @param null $department
     * @param bool $isAdmin
     * @param bool $locked
     * @param array $calender
     */
    public function __construct($email, $first_name, $last_name, $password, $picture_url, $calender = [], $subjects = [], $grade = null, $department = null, $isAdmin = false, $locked = false)
    {
        $this->email = $email;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->password = $password;
        $this->picture_url = $picture_url;
        $this->grade = $grade;
        $this->department = $department;
        $this->isAdmin = $isAdmin;
        $this->locked = $locked;
        $this->calender = $calender;
        $this->subjects =$subjects;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getPictureUrl()
    {
        return $this->picture_url;
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
        if ($grade !== $this->grade) {
            $s = get_np_mysql_object()->prepare("update user set grade = :grade where email = :email");
            $s->execute(array(
                ":email" => $this->email,
                ":grade" => $grade
            ));
            $this->grade = $grade;
        }
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
        if ($department !== $this->department) {
            $s = get_np_mysql_object()->prepare("update user set department = :department where email = :email");
            $s->execute(array(
                ":email" => $this->email,
                ":department" => $department
            ));
            $this->department = $department;
        }
    }

    /**
     * @return array|mixed
     */
    public function getSubjects(): mixed
    {
        return $this->subjects;
    }

    public function isAdmin()
    {
        return $this->isAdmin;
    }

    public function setAdmin($isAdmin)
    {
        if ($isAdmin !== $this->isAdmin) {
            $s = get_np_mysql_object()->
            prepare("update user set isAdmin = :isAdmin where email = :email");
            $s->execute(array(
                ":email" => $this->email,
                ":isAdmin" => $isAdmin
            ));
            $this->isAdmin = $isAdmin;
        }
    }

    public function isTutor()
    {
        return (!Tutor::get_tutor_by_email($this->email)) ? false : true;
    }

    public function setTutor($description, $teaching_method)
    {
        if (!$this->isTutor()) {
            Tutor::create_tutor($this->email, $description, $teaching_method);
        }
        return $this->tutor();
    }

    public function addCalender($email, $timefrom, $timeto, $weekday)
    {
        array_push($calender, Calender::createCalender($email, $timefrom, $timeto, $weekday));
    }

    public function removeCalender($id)
    {
        unset($this->calender[$id]);
    }

    /**
     * @return false
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * @param $locked
     */
    public function setLocked($locked)
    {
        if ($locked !== $this->locked) {
            $s = get_np_mysql_object()->prepare("update user set locked = :locked where email = :email");
            $s->execute(array(
                ":email" => $this->email,
                ":locked" => $locked
            ));
            $this->locked = $locked;
        }
    }

    /**
     * @return Tutor|bool
     */
    public function tutor()
    {
        $s = get_np_mysql_object()->prepare("select * from tutor where email = :email");
        $s->execute(array(":email" => $this->email));
        $obj = $s->fetch();
        if (empty($obj['grade'])) return false;
        return new Tutor($this->email, $this->first_name, $this->last_name, $this->password, $this->picture_url, $obj['description'], $obj['teaching_method'], $this->grade, $this->department, $this->isAdmin, $this->locked);
    }

    public function addSubject($name, $department, $minGrade = 1)
    {

    }

    public function deleteSubject($name)
    {

    }

    /**
     * @param $email
     * @return User|bool
     */
    public static function getUser($email)
    {
        $s = get_np_mysql_object()->prepare("select * from user where email = :email");
        $s->execute(array(":email" => $email));
        $obj = $s->fetch();
        if (empty($obj['first_name'])) return false;
        return new User($email, $obj['first_name'], $obj['last_name'], $obj['password'], $obj['picture_url'], $obj['grade'], $obj['department'], $obj['isAdmin'], $obj['locked']);
    }

    public static function get_users($count, $offset = 0)
    {
        $s = get_np_mysql_object()->prepare("select * from user limit :count offset :offset");
        $s->execute(array(
            ":count" => $count,
            ":offset" => $offset
        ));
        $objs = $s->fetchAll();
        $users = array();
        foreach ($objs as $obj)
            array_push($users, new User($obj["email"], $obj['first_name'], $obj['last_name'], $obj['password'], $obj['picture_url'], $obj['grade'], $obj['department'], $obj['isAdmin'], $obj['locked']));
        return $users;
    }

    /**
     * @param $email
     * @param $first_name
     * @param $last_name
     * @param $password
     * @param $picture_url
     * @param $isAdmin
     * @return User|bool
     */
    public static function createUser($email, $first_name, $last_name, $password, $picture_url, $isAdmin = false)
    {
        $user = self::getUser($email);
        if ($user) return false;

        $s = get_np_mysql_object()->
        prepare("insert into user (email, first_name, last_name, password, picture_url, locked, isAdmin) 
        values (:email, :first_name, :last_name, :password, :picture_url, :locked, :isAdmin)");
        $s->bindValue(':email', $email);
        $s->bindValue(':first_name', $first_name);
        $s->bindValue(':last_name', $last_name);
        $s->bindValue(':password', $password);
        $s->bindValue(':picture_url', $picture_url);
        $s->bindValue(':locked', 0);
        $s->bindValue(':isAdmin', $isAdmin);
        $s->execute();

        return new User($email, $first_name, $last_name, $password, $picture_url, $isAdmin);
    }

    /**
     * @param $email
     */
    public function deleteUser()
    {
        $s = get_np_mysql_object()->prepare("delete from user where email = :email");
        $s->execute(array(":email" => $this->email));
    }

    public function filterUser($parameters) //von $_GET
    {
        $sql_statement = "select * from tutor t join user u on u.email = t.email
            where t.email != :email
            and locked = false";

        if (!is_null($this->grade)) $sql_statement .= "and grade >= :grade";
        if (!is_null($this->department)) $sql_statement .= "and department = :department";
        //teaching method???
        //subject

        $s = get_np_mysql_object()->
        prepare($sql_statement);
        $s->bindValue(':email', $this->email);
        if (!is_null($this->grade)) $s->bindValue(':grade', $this->grade);
        if (!is_null($this->department)) $s->bindValue(':department', $this->department);
        $s->execute();
        $objsUser = $s->fetchAll();

        $users = [];
        foreach ($objsUser as $objUser) {
            $sc = get_np_mysql_object()->prepare("select * from user u join calender_free cf on u.email = cf.email where email = :email");
            $sc->execute(array(":email" => $objUser["email"]));
            $objsCalenders = $sc->fetchAll();
            if (!empty($objsCalender['calender_id'])) {
                if (compareCalender()) {
                    array_push($users, new User($objUser["email"], $objUser['first_name'], $objUser['last_name'], $objUser['password'], $objUser['picture_url'], $objUser['grade'], $objUser['department'], $objUser['isAdmin'], $objUser['locked']));
                    break;
                }
            }
        }


        return $users;

        function compareCalender($c1, $c2)
        {

        }
    }

    public function jsonSerialize()
    {
        return [
            "email" => $this->email,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "picture_url" => $this->picture_url,
            "isAdmin" => $this->isAdmin,
            "locked" => $this->locked
        ];
    }
}