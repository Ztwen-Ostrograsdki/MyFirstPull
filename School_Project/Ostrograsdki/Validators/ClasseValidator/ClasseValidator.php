<?php

namespace MyFramework\Validators\ClasseValidator;
use MyFramework\Classe\Classe;
use MyFramework\DataBaseConnect\Connected;
use MyFramework\SqlRequests\Requestor;
use \PDO;


class ClasseValidator{

	private $classe;


	public function __construct(Classe $classe)
	{
		$this->classe = $classe;
		
	}


    public function getErrors():?array
	{
		$tableName = $this->classe->getTableName();
		$name = $this->classe->getClasse();
		$responsable1 = $this->classe->getResponsable1();
		$responsable2 = $this->classe->getResponsable2();
		$principal = $this->classe->getPrincipal();
		$id = $this->classe->getId();

		$errorsTab = [];
		$wasExisted = Requestor::isAlreadyExist('id', $tableName, 'classe', $name, null, null, 'id', $id, -1);
		if ($name == null || empty($name)) {
			$errorsTab['name'] = "Veuillez renseignez le nom de la classe svp!";
		}
		elseif ($wasExisted == true) {
			$errorsTab['name'] = "Vous ne pouvez pas à nouveau inserer cette classe, elle existe déjà";
		}

		if (($responsable1 !== null || !empty($responsable1)) && ($responsable2 !== null || !empty($responsable2)) ) {
			if (Requestor::setEquals($responsable1, $responsable2)) {
				$errorsTab['responsable1'] = $errorsTab['responsable2'] = "Le même élève ne peut pas être à la fois les deux responsables!";
			}
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





