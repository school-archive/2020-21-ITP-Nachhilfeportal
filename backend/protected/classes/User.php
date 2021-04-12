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
    private $types; // 00 = not admin, not tutor || 10 = admin, not tutor || 11 = admin, tutor
    private $locked;


    /***
     * User constructor.
     * @param $email
     * @param $first_name
     * @param $last_name
     * @param $password
     * @param $picture_url
     * @param $types
     * @param $locked
     */
    public function __construct($email, $first_name, $last_name, $password, $picture_url, $types = 0, $locked = false)
    {
        $this->email = $email;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->password = $password;
        $this->picture_url = $picture_url;
        $this->types = $types;
        $this->locked = $locked;
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

    public function isTutor() {
        return ($this->types & 1) > 0;
    }

    public function isAdmin() {
        return ($this->types & 2) > 0;
    }

    public function setTutor($isTutor) {
        $this->types &= ~1; // set tutor bit to 0
        $this->types |= $isTutor;
        $this->updateTypes();
    }

    public function setAdmin($isAdmin) {
        $this->types &= ~2; // set admin bit to 0
        $this->types |= $isAdmin << 1;
        $this->updateTypes();
    }

    private function updateTypes()
    {
        $s = get_np_mysql_object()->
        prepare("update user set types = :types where email = :email");
        $s->bindValue(':email', $this->email);
        $s->bindValue(':types', $this->types, PDO::PARAM_INT);
        $s->execute();
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
        $admin = self::getUser($_SESSION["user_email"]);
        if (!is_null($admin)) {
            if($admin->isAdmin()) {
                if($locked !== $this->locked) {
                    $s = get_np_mysql_object()->prepare("update user set locked = :locked where email = :email");
                    $s->execute(array(
                        ":email" => $this->email,
                        ":locked" => $locked
                    ));
                    $this->locked = $locked;
                }
            }
        }
    }

    /**
     * @return Student|null
     */
    public function student()
    {
        require_once __DIR__ . '/Student.php';
        $s = get_np_mysql_object()->prepare("select * from student where email = :email");
        $s->execute(array(":email" => $this->email));
        $obj = $s->fetch();
        if ($obj['grade'] == null) return null;
        return new Student($this->email, $this->first_name, $this->last_name, $this->password, $this->picture_url, $obj['grade'], $obj['department'], $this->types, $this->locked);
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
        return new User($email, $obj['first_name'], $obj['last_name'], $obj['password'], $obj['picture_url'], $obj['types'], $obj['locked']);
    }

    public static function get_users($count, $offset=0) {
        $s = get_np_mysql_object()->prepare("select * from user limit :count offset :offset");
        $s->execute(array(
            ":count" => $count,
            ":offset" => $offset
        ));
        $objs = $s->fetchAll();
        $users = array();
        foreach ($objs as $obj)
            array_push($users, new User($obj["email"], $obj['first_name'], $obj['last_name'], $obj['password'], $obj['picture_url'], $obj['types'], $obj['locked']));
        return $users;
    }

    /**
     * @param $email
     * @param $first_name
     * @param $last_name
     * @param $password
     * @param $picture_url
     * @param $types
     * @return User|bool
     */
    public static function createUser($email, $first_name, $last_name, $password, $picture_url, $types = 0)
    {
        $user = self::getUser($email);
        if($user) return false;

        $s = get_np_mysql_object()->
        prepare("insert into user (email, first_name, last_name, password, picture_url, locked, types) 
        values (:email, :first_name, :last_name, :password, :picture_url, :locked, :types)");
        $s->bindValue(':email', $email);
        $s->bindValue(':first_name', $first_name);
        $s->bindValue(':last_name', $last_name);
        $s->bindValue(':password', $password);
        $s->bindValue(':picture_url', $picture_url);
        $s->bindValue(':locked', 0);
        $s->bindValue(':types', $types, PDO::PARAM_INT);
        $s->execute();

        return new User($email, $first_name, $last_name, $password, $picture_url, $types);
    }

    /**
     * @param $email
     */
    public static function deleteUser($email)
    {
        $s = get_np_mysql_object()->prepare("delete from user where email = :email");
        $s->execute(array(":email" => $email));
    }


    public function jsonSerialize()
    {
        return [
            "email" => $this->email,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "picture_url" => $this->picture_url,
            "types" => $this->types,
            "locked" => $this->locked
        ];
    }

    //TODO if valid input
}