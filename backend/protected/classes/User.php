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
    public function __construct($email, $first_name, $last_name, $password, $picture_url, $grade = null, $department = null, $isAdmin = 0, $locked = 0, $calender = array(), $subjects = [])
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
        $this->subjects = $subjects;
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

    public function setCalender($calender){
        $this->calender=$calender;
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
    public function getSubjects()
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
        return (!Tutor::get_tutor($this->email)) ? false : true;
    }

    public function setTutor($description, $teaching_method)
    {
        if (!$this->isTutor()) {
            Tutor::create_tutor($this->email, $description, $teaching_method);
        }
        return $this->tutor();
    }

    public function addCalender($email, $time_from, $time_to, $weekday)
    {
        Calender::createCalender($email, $time_from, $time_to, $weekday);

        $this->calender = $this->getCalender();

    }


    public static function removeCalender($id)
    {
        $s = get_np_mysql_object()->prepare("delete from calender_free where calender_id = :calender_id");
        $s->execute(array(":calender_id" => $id));
    }

    public function removeAllCalenderFromUser($email)
    {

        $s = get_np_mysql_object()->prepare("select * from calender_free where email = :email");
        $s->execute(array(
            ":email" => $email
        ));
        $objs = $s->fetchAll();
        foreach ($objs as $obj)
            $this->removeCalender($obj["calender_id"]);
        return $this->calender;
    }

    public function getTimeonWeekday($weekday)
    {

        $s = get_np_mysql_object()->prepare("select * from calender_free where weekday = :weekday and email = :email");
        $s->execute(array(
            ":weekday" => $weekday,
            ":email" => $this->email
        ));
        $objs = $s->fetchAll();
        if (empty($objs)) return false;

        foreach ($objs as $obj)
            array_push($this->calender, new Calender($obj["email"], $obj['time_from'], $obj['time_to'], $obj['weekday']));
        return $this->calender;
    }

    public function getCalender()
    {
        $s = get_np_mysql_object()->prepare("select * from calender_free where email = :email");
        $s->execute(array(
            ":email" => $this->email
        ));
        $objs = $s->fetchAll();
        if (empty($objs)) return [];

        $this->calender = array();
        foreach ($objs as $obj)
            array_push($this->calender, new Calender($obj["email"], $obj['time_from'], $obj['time_to'], $obj['weekday']));
        return $this->calender;

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

    public function addSubject($name)
    {
        $s1 = get_np_mysql_object()->
        prepare("insert into selected_subject (name, email) 
        values (:name, :email)");
        $s1->execute(array(
            ":email" => $this->email,
            ":name" => $name
        ));
    }

    public function deleteSubject($name)
    {
        $s = get_np_mysql_object()->prepare("delete from selected_subject where name= :name and email= :email");
        $s->execute(array(
            ":email" => $this->email,
            ":name" => $name
        ));
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
    public static function createUser($email, $first_name, $last_name, $password, $picture_url, $isAdmin = 0)
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

    /*
     * Vorübergehende Lösung, bis filterUserInBearbeitung fertig ist
     */
    public static function filterUser()
    {
        $s = get_np_mysql_object()->prepare("select * from tutor t join user u on u.email = t.email");
        $s->execute();
        $objs = $s->fetchAll();
        $tutoren = array();
        foreach ($objs as $obj)
            array_push($tutoren, new Tutor($obj["email"], $obj['first_name'], $obj['last_name'], $obj['password'], $obj['picture_url'], $obj['description'], $obj['teaching_method'], $obj['grade'], $obj['department'], $obj['isAdmin'], $obj['locked']));
        return $tutoren;

    }

    public function getSelected_Subject()
    {
        $s = get_np_mysql_object()->prepare("select * from selected_subject where email = :email");
        $s->execute(array(
            ":email" => $this->email
        ));
        $objs = $s->fetchAll();
        if (empty($objs)) return [];

        $this->subjects = array();
        foreach ($objs as $obj)
            array_push($this->subjects, Subject::getSubject($obj["name"]));
        return $this->subjects;
    }

    public function filterUserInBearbeitung() //von $_GET //($user = null)
    {
        parse_str(file_get_contents("php://input"),$put_var);

        $sql_statement = "select * from tutor t join user u on u.email = t.email
            where t.email != :email
            and locked = 0";

        //SQL-Statement Grade & Department
        if (!is_null($this->grade) || isset($put_var['grade'])) $sql_statement .= "and grade >= :grade";
        if (!is_null($this->department)  || isset($put_var['department'])) $sql_statement .= "and department = :department";


        $s = get_np_mysql_object()->prepare($sql_statement);
        $s->bindValue(':email', $this->email);

        //bind grade
        if(isset($put_var['grade'])) {
            $s->bindValue(':grade', $put_var['grade']);
        } elseif(!is_null($this->grade)) {
            $s->bindValue(':grade', $this->grade);
        }
        //bind department
        if(isset($put_var['department'])) {
            $s->bindValue(':department', $put_var['department']);
        } elseif(!is_null($this->department)) {
            $s->bindValue(':department', $this->department);
        }

        $s->execute();
        $objsUser = $s->fetchAll();

        //subjects with exists in sql statemnt?

        $users = [];

        /*foreach ($objsUser as $objUser) {



            $sc = get_np_mysql_object()->prepare("select * from user u join calender_free cf on u.email = cf.email where email = :email");
            $sc->execute(array(":email" => $objUser["email"]));
            $objsCalenders = $sc->fetchAll();
            if (!empty($objsCalender['calender_id'])) {
                if (compareCalender()) {
                    array_push($users, new User($objUser["email"], $objUser['first_name'], $objUser['last_name'], $objUser['password'], $objUser['picture_url'], $objUser['grade'], $objUser['department'], $objUser['isAdmin'], $objUser['locked']));
                    break;
                }
            }
        }*/


        return $objsUser;
    }

    public function jsonSerialize()
    {
        return [
            "email" => $this->getEmail(),
            "first_name" => $this->getFirstName(),
            "last_name" => $this->getLastName(),
            "picture_url" => $this->getPictureUrl(),
            "grade" => $this->getGrade(),
            "department" => $this->getDepartment(),
            "isAdmin" => $this->isAdmin(),
            "locked" => $this->getLocked(),
            "calender" => $this->getCalender()
        ];
    }
}