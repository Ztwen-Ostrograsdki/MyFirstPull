<?php
namespace MyFramework\Validators\PupilValidator;

use MyFramework\DataBaseConnect\Connected;
use MyFramework\PupilsInfos\Pupil\Pupil;
use MyFramework\SqlRequests\Requestor;
use \PDO;


class PupilValidator{

	private $pupil;

	public function __construct(Pupil $pupil)
	{
		$this->pupil = $pupil;
	}


    public function getPupilErrors():?array
	{
		$tableName = $this->pupil->getTableName();
		$name = $this->pupil->getName();
		$id = $this->pupil->getId();
		$surname = $this->pupil->getSurname();
		$classe = $this->pupil->getClasse();
		$sexe = $this->pupil->getSexe();
		$birthday = $this->pupil->getBirthday();
		
		$errorsTab = [];
		$wasExisted = Requestor::isAlreadyExist('id', $tableName, 'name', $name, 'surname', $surname, 'id', $id, -1);
		if (($name !== null && !empty($name)) && ($surname !== null && !empty($surname))) {
			if (Requestor::lengthBetween($name, 3, 100) && Requestor::lengthBetween($surname, 3, 100)) {
				if ($wasExisted === true) {
					$errorsTab['name'] = "Vous ne pouvez pas à nouveau inscrit cet élève!";
					$errorsTab['surname'] = "Vous ne pouvez pas à nouveau inscrit cet élève!";
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
			if ($name !== null && empty($name)) {
				$errorsTab['name'] = "Veuillez renseigner le nom de l'élève!";
			}
			if ($surname !== null && empty($surname)) {
				$errorsTab['surname'] = "Veuillez renseigner les prénoms de l'élève!";
			}
		}

		if ($classe !== null && !empty($classe)) {
			$classeTruth = Requestor::isAlreadyExist('id', 'list_of_classes', 'classe', $classe);
			if (!$classeTruth) {
				$errorsTab['classe'] = "La classe que vous avez renseigné n'existe pas dans cette école!";
			}
		}
		else{
			$errorsTab['classe'] = "Veuillez renseigner une classe d'appartenance!";
		}

		if ($sexe !== null && !empty($sexe)) {
			if ($sexe !== 'Masculin' && $sexe !== 'Feminin') {
				$errorsTab['sexe'] = "Le sexe que vous avez renseigné est invalide!";
			}
		}
		else{
			$errorsTab['sexe'] = "Veuillez renseigner le genre de l'élève!";
		}


		if ($birthday !== null && !empty($birthday)) {
			# code...
		}
		else{
			$errorsTab['birthday'] = "Veuillez renseigner la date de naissance de l'élève!";

		}

		return $errorsTab;

	}


	public function getParentErrors():?array
	{
		$father = $this->pupil->getFather();
		$mother = $this->pupil->getMother();
		$tutor = $this->pupil->getTutor();
		$phone = $this->pupil->getPhone();
		$address = $this->pupil->getAddress();

		$errorsTab = [];


		if ($phone !== null && !empty($phone)) {
			if (!Requestor::lengthBetween($phone, 8, 16)) {
				$errorsTab['phone'] = "Le contact que vous avez renseigné est invalide!";
			}
		}
		else{
			$errorsTab['phone'] = "Veuillez renseigner le contact des parents de l'élève!";
		}

		if ($father !== null && !empty($father)) {
			if (!Requestor::lengthBetween($father, 5, 100)) {
				$errorsTab['father'] = "La taille des noms et prénoms du père de l'élève sont invalide!";
			}
		}
		else{
			$errorsTab['father'] = "Veuillez renseigner les noms et prénoms du père de l'élève!";
		}

		if ($mother !== null && !empty($mother)) {
			if (!Requestor::lengthBetween($mother, 5, 100)) {
				$errorsTab['mother'] = "La taille des noms et prénoms de la mère de l'élève sont invalide!";
			}
		}
		else{
			$errorsTab['mother'] = "Veuillez renseigner les noms et prénoms de la mère de l'élève!";
		}

		if ($tutor !== null && !empty($tutor)) {
			if (!Requestor::lengthBetween($tutor, 5, 100)) {
				$errorsTab['tutor'] = "La taille des noms et prénoms du tuteur de l'élève sont invalide!";
				
			}
		}
		else{
			$errorsTab['tutor'] = "Veuillez renseigner les noms et prénoms du tuteur de l'élève!";
		}
		
		return $errorsTab;
	}

}





