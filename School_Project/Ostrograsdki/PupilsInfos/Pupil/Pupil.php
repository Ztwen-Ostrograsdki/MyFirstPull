<?php

namespace MyFramework\PupilsInfos\Pupil;

use MyFramework\Connected\Connected;
use MyFramework\Helpers\Templates\Templates;
use MyFramework\SqlRequests\Requestor;

class Pupil{

    private $tableName = 'list_of_pupils';

    /**
     * The id of the pupil
     * @var int
     */
	private $id;
	private $name;
	private $surname;
	private $birthday;
	private $father;
	private $mother;
	private $tutor;
	private $address;
	private $age;
	private $sexe;
	private $parent_phone_number;
	private $marks;//object
	private $classe;//object
	private $is_responsable;
	private $level;
	

    /**
     * @return int|null
     */
    public function getId():?int
    {
        return (int)$this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = strtoupper($name);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     *
     * @return self
     */
    public function setSurname($surname)
    {
        $this->surname = ucwords($surname);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
     
        return $this->birthday;
    }

    /**
     * @return mixed
     */
    public function getFormattedBirthday()
    {
        
        $parts = array_reverse(explode('-', $this->birthday));
        $month = Requestor::monthOfADate($parts[1]);
        unset($parts[1]);
        $date = implode(' '.$month.' ', $parts);

        return $date;
    }

    /**
     * @param mixed $birthday
     *
     * @return self
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFather()
    {
        return $this->father;
    }

    /**
     * @param mixed $father
     *
     * @return self
     */
    public function setFather($father)
    {
        $this->father = Templates::formattedNameAndSurname($father);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMother()
    {
        return $this->mother;
    }

    /**
     * @param mixed $mother
     *
     * @return self
     */
    public function setMother($mother)
    {
        $this->mother = Templates::formattedNameAndSurname($mother);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTutor()
    {
        return $this->tutor;
    }

    /**
     * @param mixed $tutor
     *
     * @return self
     */
    public function setTutor($tutor)
    {

        $this->tutor = Templates::formattedNameAndSurname($tutor);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     *
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
    	$parts = array_reverse(explode('-', $this->birthday));
    	$d = (int)$parts[0];
    	$m = (int)$parts[1];
    	$y = (int)$parts[2];
    	$older = mktime(0, 0, 0, $m, $d, $y);
    	$now = time();
    	$this->age = (int)(abs($older - $now) / (3600*24*30*12))." ans";
        return $this->age;
    }

    /**
     * @param mixed $age
     *
     * @return self
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->parent_phone_number;
    }

    /**
     * @param mixed $phone
     *
     * @return self
     */
    public function setPhone($phone)
    {
        $this->parent_phone_number = $phone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMarks()
    {
        return $this->marks;
    }

    /**
     * @param mixed $marks
     *
     * @return self
     */
    public function setMarks($marks)
    {
        $this->marks = $marks;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param mixed $classe
     *
     * @return self
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsResponsable()
    {
        if ($this->is_responsable == 1) {
            return "Oui";
        }
        else{
            return "Non";
        }
    }

    /**
     * @param mixed $is_responsable
     *
     * @return self
     */
    public function setIsResponsable($is_responsable)
    {
        if ($is_responsable == 'Oui') {
            $this->is_responsable = 1;
        }
        else{
            $this->is_responsable = 0;
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     *
     * @return self
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed $sexe
     *
     * @return self
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param mixed $tableName
     *
     * @return self
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
    }


    public function updateThisPupilInfo()
    {
        if ($this->getIsResponsable() == "Oui") {
           $is_responsable = 1;
        }
        else{
            $is_responsable = 0;
        }

        $cbd = (new Connected())->connectedToDataBase();
        $req = $cbd->prepare("UPDATE {$this->tableName} SET name = ?, surname = ?, birthday = ?, sexe = ?, classe = ?, is_responsable = ?  WHERE id = ?");
        $req->execute([$this->getName(), $this->getSurname(), $this->getBirthday(), $this->getSexe(), $this->getClasse(), $is_responsable, $this->getId()]);
        return $is_responsable;
    }

    public function updateThisPupilParentsInfo()
    {
        $cbd = (new Connected())->connectedToDataBase();
        $req = $cbd->prepare("UPDATE {$this->tableName} SET father = ?, mother = ?, tutor = ?, parent_phone_number = ?, address = ? WHERE id = ?");
        $req->execute([$this->getFather(), $this->getMother(), $this->getTutor(), $this->getPhone(), $this->getAddress(), $this->getId()]);
    }

    public function updateResponsableStatus()
    {
        $responsable1 = $this->getName()." ".$this->getSurname();
        $cbd = (new Connected())->connectedToDataBase();
        $req1 = $cbd->prepare("UPDATE {$this->tableName} SET is_responsable = ? WHERE (id != ? AND classe = ?)");
        $req2 = $cbd->prepare("UPDATE list_of_classes SET responsable1 = ? WHERE classe = ?");
        $req1->execute([0, $this->getId(), $this->getClasse()]);
        $req2->execute([$responsable1, $this->getClasse()]);
    }
}