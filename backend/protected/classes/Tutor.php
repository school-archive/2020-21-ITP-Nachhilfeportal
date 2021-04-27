<?php
namespace classes;
require_once __DIR__ . '/../vendor/autoload.php';
use PDO;

class Tutor extends User
{
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
        parent::__construct($email, $first_name, $last_name, $password, $picture_url,$grade, $department, $isAdmin, $locked);
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
        return $this->teaching_method;
    }

    /**
     * @param $teaching_method
     */

    public function setTeaching_method($teaching_method)
    {
        $this->teaching_method = $teaching_method;
    }

    /**
     * @param $email
     * @return Tutor
     */

    public static function get_Tutor_by_email($email)
    {
        $s = get_np_mysql_object()->prepare("select * from tutor where email = :email join user");
        $s->execute(array(":email" => $email));
        $obj = $s->fetch();
        if (empty($obj['email'])) return false;
        $tutor = new Tutor($email,$first_name, $last_name, $password, $picture_url,$grade, $department, $isAdmin, $locked, $obj['description'], $obj['teaching_method']);
        $tutor->setDescription($obj['description']);
        $tutor->setTeaching_method($obj['teaching_method']);
        return $tutor;
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
        prepare("insert into tutor (desciption, teaching_method) 
        values (:description, :teaching_method");
        $s->execute(array(
            ":description" => $description,
            ":teaching_method" => $teaching_method
        ));
        return new Tutor($email, $description, $teaching_method);
    }


    public function jsonSerialize()
    {
        return [
            "description" => $this->description,
            "teaching_method" => $this->teaching_method
        ];
    }
}