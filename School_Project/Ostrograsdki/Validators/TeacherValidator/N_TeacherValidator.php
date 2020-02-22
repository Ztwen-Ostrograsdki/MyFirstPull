<?php
namespace MyFramework\Validators\TeacherValidator;

use MyFramework\DataBaseConnect\Connected;
use MyFramework\SqlRequests\Requestor;
use MyFramework\Teacher\NewTeacher;
use \PDO;


class N_TeacherValidator{

	private $teacher;

	public function __construct(NewTeacher $teacher)
	{
		$this->teacher = $teacher;
	}


    public function getErrors():?array
	{
		$tableName = $this->teacher->getTableName();
		$name = $this->teacher->getName();
		$surname = $this->teacher->getSurname();
		$discipline = $this->teacher->getDiscipline();
		$classes = $this->teacher->getClasses();
		$sexe = $this->teacher->getSexe();
		$contact = $this->teacher->getContact();
		$address = $this->teacher->getAddress();
		
		$errorsTab = [];
		$wasExisted = Requestor::isAlreadyExist('id', $tableName, 'name', $name, 'surname', $surname);

		if (($name !== null && !empty($name)) && ($surname !== null && !empty($surname))) {
			if (Requestor::lengthBetween($name, 3, 100) && Requestor::lengthBetween($surname, 3, 100)) {
				if ($wasExisted === true) {
					$errorsTab['name'] = "Vous ne pouvez pas inscrit cet enseignant à nouveau!";
					$errorsTab['surname'] = "Vous ne pouvez pas inscrit cet enseignant à nouveau!";
				}
			}
			else{
				if (!Requestor::lengthBetween($name, 3, 100)) {
					$errorsTab['name'] = "La longeur du nom est invalide!";
				}
				if (!Requestor::lengthBetween($surname, 3, 100)) {
					$errorsTab['surname'] = "La longeur du prénoms est invalide!";
				}
			}
		}
		else{
			if ($name == null && empty($name)) {
				$errorsTab['name'] = "Veuillez renseigner le nom du professeur!";
			}
			if ($surname == null && empty($surname)) {
				$errorsTab['surname'] = "Veuillez renseigner les prénoms du professeur!";
			}
		}

		if ($classes !== [] && !empty($classes)) {
			for ($i=0; $i < count($classes) ; $i++) { 
				$classeTruth = Requestor::isAlreadyExist('id', 'list_of_classes', 'classe', $classes[$i]);
				if (!$classeTruth) {
					$errorsTab['classe'] = "La classe que vous avez renseigné n'existe pas dans cette école!";
				}
			}
		}
		else{
			$errorsTab['classe'] = "Veuillez renseigner au moins une classe d'appartenance!";
		}

		if ($sexe !== null && !empty($sexe)) {
			if ($sexe !== 'Masculin' && $sexe !== 'Feminin') {
				$errorsTab['sexe'] = "Le sexe que vous avez renseigné est invalide!";
			}
		}
		else{
			$errorsTab['sexe'] = "Veuillez renseigner le genre de l'élève!";
		}

		if ($contact !== null && !empty($contact)) {
			if (!Requestor::lengthBetween($contact, 8, 16)) {
				$errorsTab['contact'] = "Le contact que vous avez renseigné est invalide!";
			}
		}
		else{
			$errorsTab['contact'] = "Veuillez renseigner le contact du professeur!";
		}

		if ($discipline !== null && !empty($discipline)) {
			$truthDiscipline = Requestor::isAlreadyExist('id', 'list_of_disciplines', 'discipline', $discipline);
			if ($truthDiscipline) {
				
			}
			else{
				$errorsTab['discipline'] = "La discipline que vous avez renseigné n'existe pas!";
			}
		}
		else{
			$errorsTab['discipline'] = "Veuillez renseigner la discipline enseignée par le professeur!";
		}

		if ($address !== null && !empty($address)) {
			if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
				$errorsTab['address'] = "L'addresse mail que vous avez renseigné est invalide!";
			}
		}
		else{
			$errorsTab['address'] = "Veuillez renseigner l'address email du professeur!";
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





