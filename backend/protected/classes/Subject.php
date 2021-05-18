<?php


namespace classes;

use http\Exception\InvalidArgumentException;
use JsonSerializable;
use PDO;
use function PHPUnit\Framework\throwException;

require_once __DIR__ . '/../vendor/autoload.php';

class Subject implements JsonSerializable
{
    private $name;
    private $department;
    private $minGrade;

    /**
     * Subject constructor.
     * @param $name
     * @param $department
     * @param int $minGrade
     * Summary department = 'ME|IT|FS' (Bsp: '001')
     */
    public function __construct($name, $department, $minGrade = 1)
    {
        $this->name = $name;
        $this->department = bindec($department);
        $this->minGrade = $minGrade;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        if ($name !== $this->name) {
            $s = get_np_mysql_object()->prepare("update subject set name = :name where name = :lastname");
            $s->execute(array(
                ":name" => $name,
                ":lastname" => $this->name
            ));
            $this->name = $name;
        }
    }

    /**
     * @return mixed
     */
    public function getDepartment()
    {
        switch ($this->department) {
            case 1:
                $values = array(
                    "ME" => false,
                    "IT" => false,
                    "FS" => true);
                break;
            case 2:
                $values = array(
                    "ME" => false,
                    "IT" => true,
                    "FS" => false);
                break;
            case 4:
                $values = array(
                    "ME" => true,
                    "IT" => false,
                    "FS" => false);
                break;
            case 5:
                $values = array(
                    "ME" => true,
                    "IT" => false,
                    "FS" => true);
                break;
            case 6:
                $values = array(
                    "ME" => true,
                    "IT" => true,
                    "FS" => false);
                break;
            case 7:
                $values = array(
                    "ME" => true,
                    "IT" => true,
                    "FS" => true);
                break;
            default:
                return false;
        }

        return $values;
    }

    function setDepartment(): void
    {
        $s = get_np_mysql_object()->prepare("update subject set department = :department where name = :name");
        $s->bindValue(':name', $this->name);
        $s->bindValue(':department', $this->department, PDO::PARAM_INT);
        $s->execute();
    }

    public function setME($bool)
    {
        $this->department &= ~4;
        if ($bool) $this->department |= 4;

        $this->setDepartment();
    }


    public function setIT($bool)
    {
        $this->department &= ~2;
        if ($bool) $this->department |= 2;

        $this->setDepartment();
    }

    public function setFS($bool)
    {
        $this->department &= ~1;
        if ($bool) $this->department |= 1;

        $this->setDepartment();
    }

    /**
     * @return int|mixed
     */
    public function getMinGrade()
    {
        return $this->minGrade;
    }

    /**
     * @param int|mixed $minGrade
     */
    public function setMinGrade(int $minGrade): void
    {
        if ($minGrade !== $this->minGrade) {
            $s = get_np_mysql_object()->prepare("update subject set minGrade = :minGrade where name = :name");
            $s->execute(array(
                ":name" => $this->name,
                ":minGrade" => $minGrade
            ));
            $this->minGrade = $minGrade;
        }
    }

    //department = string (example: '001')
    public static function createSubject($name, $department, $minGrade = 1)
    {
        $subject = User::getSubject($name);
        if ($subject) return false;

        $s2 = get_np_mysql_object()->
        prepare("insert into subject (name, department, minGrade ) 
        values (:name, :department, :minGrade)");
        $s2->bindValue(':name', $name);
        $s2->bindValue(':department', bindec($department), PDO::PARAM_INT);
        $s2->bindValue(':minGrade', $minGrade);
        $s2->execute();

        return new Subject($name, $department, $minGrade);
    }


    public function deleteSubject()
    {
        $s = get_np_mysql_object()->prepare("delete from subject where name = :name");
        $s->execute(array(":name" => $this->name));
    }

    public static function get_subjects($count, $offset = 0)
    {
        $s = get_np_mysql_object()->prepare("select * from subject limit :count offset :offset");
        $s->execute(array(
            ":count" => $count,
            ":offset" => $offset
        ));
        $objs = $s->fetchAll();
        $subjects = array();
        foreach ($objs as $obj)
            array_push($users, new Subject($obj["name"], $obj['department'], $obj['minGrade']));
        return $subjects;
    }

    public function __toString()
    {
        return 'name = ' . $this->getName() .
            ' department = ' . $this->getDepartment() .
            ' minGrade = ' . $this->getMinGrade();
    }


    public function jsonSerialize()
    {
        return [
            "name" => $this->name,
            "department" => $this->department,
            "minGrade" => $this->minGrade
        ];
    }

}