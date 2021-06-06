<?php

namespace classes;
require_once __DIR__ . '/../vendor/autoload.php';

use PDO;

class Tutor extends User
{
    private $email;
    private $description;
    private $teaching_method;

    /**
     * Tutor constructor.
     * @param $email
     * @param $first_name
     * @param $last_name
     * @param $password
     * @param $picture_url
     * @param $description
     * @param $teaching_method
     * @param $grade
     * @param $department
     * @param bool $isAdmin
     * @param false $locked
     */
    public function __construct($email, $first_name, $last_name, $password, $picture_url, $description, $teaching_method, $grade, $department, $isAdmin = false, $locked = false)
    {
        parent::__construct($email, $first_name, $last_name, $password, $picture_url, $grade, $department, $isAdmin, $locked);
        $this->email = $email;
        $this->description = $description;
        $this->teaching_method = $teaching_method;
    }

    /**
     * @return mixed $description
     */

    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     */

    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed $teaching_method
     */

    public function getTeaching_method()
    {
        switch ($this->teaching_method) {
            case 1:
                $values = ['Vorort'];
                break;
            case 2:
                $values = ['Online'];
                break;
            case 3:
                $values = ['Vorort', 'Online'];
                break;
            default:
                $values = [];
                break;
        }

        return $values;
    }

    public function isTM_online()
    {
        return in_array('Online', $this->getTeaching_method());
    }

    public function isTM_present()
    {
        return in_array('Vorort', $this->getTeaching_method());
    }

    /**
     * @param $teaching_method
     */

    public function setTeaching_method()
    {
        $s = get_np_mysql_object()->prepare("update tutor set teaching_method = :teaching_method where email = :email");
        $s->bindValue(':email', $this->email);
        $s->bindValue(':teaching_method', $this->teaching_method, PDO::PARAM_INT);
        $s->execute();
    }

    public function setTM_online($bool)
    {
        $this->teaching_method &= ~2;
        if ($bool) $this->teaching_method |= 2;
        $this->setTeaching_method();

    }

    public function setTM_present($bool)
    {

        $this->teaching_method &= ~1;
        if ($bool) $this->teaching_method |= 1;

        $this->setTeaching_method();
    }


    /**
     * @param $email
     * @return Tutor|bool
     */

    public static function get_Tutor($email)
    {
        $s = get_np_mysql_object()->prepare("select * from tutor where email = :email");
        $s->execute(array(":email" => $email));
        $obj = $s->fetch();
        if (empty($obj['email'])) return false;
        return new Tutor($email, $obj['first_name'], $obj['last_name'], $obj['password'], $obj['picture_url'], $obj['grade'], $obj['department'], $obj['isAdmin'], $obj['locked'], $obj['description'], $obj['teaching_method']);
    }

    public function delete_tutor()
    {
        $s = get_np_mysql_object()->prepare("delete from tutor where email = :email");
        $s->execute(array(":email" => $this->email));
    }

    /**
     * @param $email
     * @param $description
     * @param $teaching_method
     * @return Tutor
     */
    public static function create_tutor($email, $description, $teaching_method)
    {
        $s = get_np_mysql_object()->
        prepare("insert into tutor (email, description, teaching_method) 
        values (:email, :description, :teaching_method)");
        $s->bindValue(':email', $email);
        $s->bindValue(':description', $description);
        $s->bindValue(':teaching_method', $teaching_method);
        $s->execute();
    }


    public function jsonSerialize()
    {

        $user = User::getUser($this->email);
        return [
            "first_name" => $user->getFirstName(),
            "last_name" => $user->getLastName(),
            "picture_url" => $user->getPictureUrl(),
            "grade" => $user->getGrade(),
            "department" => $user->getDepartment(),
            "locked" => $user->getLocked(),
            "isAdmin" => $user->isAdmin(),
            "calender" => $user->getCalender(),
            "subjects" => $user->getSelected_Subject(),
            "description" => $this->getDescription(),
            "teaching_method" => $this->getTeaching_method()
        ];
    }
}