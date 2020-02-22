<?php
namespace MyFramework\Validators\DisciplineValidator;

use MyFramework\Discipline\NewDiscipline;
use MyFramework\SqlRequests\Requestor;


class N_DisciplineValidator{

	private $discipline;

	public function __construct(NewDiscipline $discipline)
	{
		$this->discipline = $discipline->getDiscipline();
	}


	public function getErrors()
	{
		$errorsTab = [];

		$discipline = $this->discipline;
		$is_already_set = Requestor::isAlreadyExist('id', 'list_of_disciplines', 'discipline', $discipline);
		if ($discipline !== null && !empty($discipline)) {
			if ($is_already_set) {
				$errorsTab['discipline'] = "La discipline que vous tentez d'inserer est déjà existante!";
			}
		}
		else{
			$errorsTab['discipline'] = "Veuillez renseigner le nom de la discipline svp!";
		}

		return $errorsTab;
	}
}