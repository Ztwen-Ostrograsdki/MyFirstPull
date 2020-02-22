<?php

namespace MyFramework\PupilsInfos\Pupil;

use MyFramework\Connected\Connected;
use MyFramework\Helpers\Templates\Templates;



class NewPupil{
	
	private $tableName = 'list_of_pupils';

	private $name;

	private $surname;

	private $classe;

    private $father;

    private $mother;

    private $tutor;

	private $birthday;

	private $sexe;

	private $phone;

    private $address;

    private $level;


	public function __construct(string $name, string $surname, $birthday, string $classe, string $father, string $mother, string $tutor, string $sexe, int $phone, string $level)
	{


		$this->name = strtoupper($name);
		$this->surname = ucwords($surname);
		$this->birthday = $birthday;
        $this->classe = ucfirst($classe);
        $this->father = Templates::formattedNameAndSurname($father);
        $this->mother = Templates::formattedNameAndSurname($mother);
		$this->tutor = Templates::formattedNameAndSurname($tutor);
		$this->sexe = $sexe;
        $this->phone = $phone;
		$this->level = $level;
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
        $this->name = $name;

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
        $this->surname = $surname;

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
    public function getBirthday()
    {
        return $this->birthday;
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
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     *
     * @return self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

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
        $this->father = $father;

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
        $this->mother = $mother;

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
        $this->tutor = $tutor;

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
     * Use to insert a new class into the table
     * @return int|null the id of the current inserted class
     */
    public function insertIntoTableOfPupils():?int
    {
        $cbd = (new Connected())->connectedToDataBase();
        $query = "INSERT INTO list_of_pupils (name, surname, birthday, classe, father, mother, tutor, sexe, parent_phone_number, level) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $cbd->prepare($query)->execute([$this->name, $this->surname, $this->birthday, $this->classe, $this->father, $this->mother, $this->tutor, $this->sexe, $this->phone, $this->level]);
        return $cbd->lastInsertId();
    }

    /**
     * Use to update a class from the table
     * @return void
     */
    public function updateThisPupil():void
    {
        $cbd = (new Connected())->connectedToDataBase();
        $query = "UPDATE list_of_classes SET  VALUES (?)";
        
    }

  
}