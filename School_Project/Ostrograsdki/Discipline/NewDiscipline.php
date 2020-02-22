<?php
namespace MyFramework\Discipline;

use MyFramework\Connected\Connected;
use MyFramework\Helpers\Templates\Templates;


class NewDiscipline{

	private $tableName = 'list_of_disciplines';

	private $discipline;

    private $level;


	public function __construct(string $discipline, $level)
	{

        $this->discipline = $discipline;
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
    public function insertIntoTableOfDisciplines():?int
    {
        $cbd = (new Connected())->connectedToDataBase();
    	$query = "INSERT INTO list_of_disciplines (discipline, level) VALUES (?, ?)";
    	$cbd->prepare($query)->execute([$this->discipline, $this->level]);
    
        return $cbd->lastInsertId();
    }


   
}	