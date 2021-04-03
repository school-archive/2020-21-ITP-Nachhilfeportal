<?php
require_once __DIR__ . '/../mysql_manager.php';

class User implements JsonSerializable
{
    private $email;
    private $first_name;
    private $last_name;
    private $password;
    private $picture_url;
    private $types;
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

    /**
     * @return mixed
     */
    public function getTypes()
    {
        return $this->types;
    }

    /***
     * @param $types
     */
    public function setTypes($types)
    {
        //TODO wenn ein typ nicht mehr, dann diesen löschen
        if($types !== $this->types) {
            $s = get_np_mysql_object()->
            prepare("update user set types = :types where email = :email");
            $s->bindValue(':email', $this->email);
            $s->bindValue(':types', $types, PDO::PARAM_INT);
            $s->execute();
            $this->types = $types;
        }
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
        if($locked !== $this->locked) {
            $s = get_np_mysql_object()->
            prepare("update user set locked = :locked where email = :email");
            $s->execute(array(
                ":email" => $this->email,
                ":locked" => $locked
            ));
            $this->locked = $locked;
        }
    }


    public function student()
    {
        //TODO function
    }


    /**
     * @param $email
     * @return User
     */
    public static function getUser($email)
    {
        $s = get_np_mysql_object()->prepare("select * from user where email = :email");
        $s->execute(array(":email" => $email));
        $obj = $s->fetch();
        if ($obj['first_name'] == null) return null;
        return new User($email, $obj['first_name'], $obj['last_name'], $obj['password'], $obj['picture_url'], $obj['types'], $obj['locked']);
    }

    /**
     * @param $email
     * @param $first_name
     * @param $last_name
     * @param $password
     * @param $picture_url
     * @param $types
     * @return User
     */
    public static function createUser($email, $first_name, $last_name, $password, $picture_url, $types = 0)
    {
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
            "password" => $this->password,
            "types" => $this->types,
            "locked" => $this->locked
        ];
    }

    //TODO authentication
    //TODO if valid input
}