<?php


class User
{
    private $first_name;
    private $last_name;
    private $password;
    private $picture_url;
    private $locked;
    private $types;


    /***
     * User constructor.
     * @param $first_name
     * @param $last_name
     * @param $password
     * @param $picture_url
     */
    public function __construct($first_name, $last_name, $password, $picture_url)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->password = $password;
        $this->picture_url = $picture_url;
        $this->locked = false;
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
     * @return false
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * @param false $locked
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;
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
        $this->types = $types;
    }


    static function get_user_by_email($email) {
        $s = get_np_mysql_object()->prepare("select * from user where email = :email");
        $s->execute(array(":email" => $email));
        $obj = $s->fetch();
        $user = new User($email, $obj['first_name'], $obj['last_name'], $obj['password'], $obj['picture_url']);
        $user->setLocked($obj['locked']);
        $user->setTypes($obj['types']);
        return $user;
    }
}