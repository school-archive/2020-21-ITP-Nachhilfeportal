<?php
require_once __DIR__ . '/../mysql_manager.php';

class Tutor extends Student
{
    private $description;
    private $teaching_method;

    /**
     * Tutor constructor.
     * @param $description
     * @param $teaching_method
     */
    public function __construct($description, $teaching_method, $grade, $department)
    {
        parent::__construct($grade, $department);
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

    static function get_tutor_by_email($email)
    {
        $s = get_np_mysql_object()->prepare("select * from tutor where email = :email");
        $s->execute(array(":email" => $email));
        $obj = $s->fetch();
        $tutor = new tutor($email, $obj['description'], $obj['teaching_method']);
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
    static function create_tutor($email, $description, $teaching_method)
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