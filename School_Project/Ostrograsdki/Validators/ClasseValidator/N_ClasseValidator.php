<?php
namespace MyFramework\Validators\ClasseValidator;

use MyFramework\Classe\NewClasse;
use MyFramework\DataBaseConnect\Connected;
use MyFramework\Registers\BuidingClass;
use MyFramework\SqlRequests\Requestor;
use \PDO;


class N_ClasseValidator{

	private $tableName;

	private $classe;

	private $name;

	private $id;

	public function __construct(NewClasse $classe)
	{
		$this->classe = $classe;
		$this->name = $classe->getClasse();
		$this->id = $classe->getId();
		$this->tableName = $classe->getTableName();
	}


    public function getErrors():?array
	{
		$errorsTab = [];
		$wasExisted = Requestor::isAlreadyExist('id', $this->tableName, 'classe', $this->name);

		if ($this->name == null || empty($this->name)) {
			$errorsTab['name'] = "Veuillez renseignez le nom de la classe svp!";
		}
		elseif ($wasExisted == true) {
			$errorsTab['name'] = "Vous ne pouvez pas à nouveau inserer cette classe, elle existe déjà";
		}

		return $errorsTab;

	}

	/**
	 * [theyAreAnyErrors description]
	 * @return bool
	 */
	public function theyAreAnyErrors():bool
	{
		return empty($this->getErrors());
	}
}





