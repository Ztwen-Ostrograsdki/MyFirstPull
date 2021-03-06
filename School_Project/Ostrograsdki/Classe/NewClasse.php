<?php

namespace MyFramework\Classe;

use MyFramework\Connected\Connected;


class NewClasse{


	private $tableName = 'list_of_classes';

	private $classe;

	private $id;

    private $level;


	public function __construct(string $classe, string $level)
	{
		$this->classe = $classe;
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
    public function getClasse()
    {
        return ucfirst($this->classe);
    }

    /**
     * @param mixed $classe
     *
     * @return self
     */
    public function setClasse($classe)
    {
        $this->classe = ucfirst($classe);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
	public function insertIntoTableOfClasses():?int
	{
		$cbd = (new Connected())->connectedToDataBase();
		$query = "INSERT INTO list_of_classes (classe, level) VALUES (?, ?)";
		$cbd->prepare($query)->execute([ucfirst($this->classe), $this->level]);
		return $cbd->lastInsertId();
	}

	/**
	 * Use to update a class from the table
	 * @return void
	 */
	public function updateThisClasse():void
	{
		$cbd = (new Connected())->connectedToDataBase();
		$query = "UPDATE list_of_classes SET  VALUES (?)";
		
	}


    
}