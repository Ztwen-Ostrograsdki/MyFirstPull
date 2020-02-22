<?php

namespace MyFramework\Teacher;

use MyFramework\Connected\Connected;
use MyFramework\SqlRequests\Requestor;



class NewTeacher{
	
	private $tableName = 'list_of_teachers';

	private $name;

	private $surname;

	private $discipline;

	private $sexe;

	private $contact;

	private $address;

	private $classes;//slug: id_classe1-id_classe2-...

    private $level;

	


	public function __construct(string $name, string $surname, string $level, string $discipline, string $sexe, int $contact, string $address, array $classes = [])
	{
		$this->name = strtoupper($name);
		$this->surname = ucfirst($surname);
        $this->level = $level;
		$this->discipline = $discipline;
		$this->sexe = $sexe;
		$this->contact = $contact;
		$this->address = $address;
		if ($classes !== []) {
    		$cbd = (new Connected())->connectedToDataBase();
    		$id_classes = [];
    		for ($i=0; $i < count($classes) ; $i++) { 
    			$id_classes[] = Requestor::getContentWithWhere('id', 'list_of_classes', 'classe', $classes[$i]);
    		}
    		$classes = implode('-', $id_classes);
    	}
		$this->classes = $classes;
		
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
    public function getDiscipline()
    {
        return $this->discipline;
    }

    /**
     * @param mixed $discipline
     *
     * @return self
     */
    public function setDiscipline($discipline)
    {
        $this->discipline = $discipline;

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
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     *
     * @return self
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

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
    public function getClasses()
    {
    	$cbd = (new Connected())->connectedToDataBase();
    		$id_classes = $this->classes;
    		$classes_by_id = explode('-', $id_classes);
    		$classes = [];
    		for ($i=0; $i < count($classes_by_id) ; $i++) { 
    			$classes[] = Requestor::getContentWithWhere('classe', 'list_of_classes', 'id', $classes_by_id[$i]);
    		}

        return $classes;
    }

    /**
     * @return mixed
     */
    public function getClassesOnID()
    {
       
        return $this->classes;
    }


    /**
     * @param array $classes
     *
     * @return self
     */
    public function setClasses(array $classes)
    {
    	
        $this->classes = $classes;
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
    public function insertThisTeacherIntoTable():?int
    {
        $cbd = (new Connected())->connectedToDataBase();
        $query = "INSERT INTO list_of_teachers (name, surname, level, discipline, sexe, contact, address, classes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $cbd->prepare($query)->execute([$this->getName(), $this->getSurname(), $this->getLevel(), $this->getDiscipline(), $this->getSexe(), $this->getContact(), $this->getAddress(), $this->getClassesOnID()]);
        return $cbd->lastInsertId();
    }


}