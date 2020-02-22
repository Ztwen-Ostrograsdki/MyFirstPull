<?php 

use MyFramework\Auth\URLAuth\URLAuth;
use MyFramework\Classe\Classe;
use MyFramework\HTMLFormat\Form;
use MyFramework\Helpers\Templates\Templates;
use MyFramework\PupilsInfos\Pupil\Pupil;
use MyFramework\SqlRequests\Requestor;
use MyFramework\Validators\PupilValidator\PupilValidator;


$forWho = $params['forWho'];
$id = (int)$params['id'];
$level = htmlspecialchars($params['level']);
// URLAuth::urlLevelAuthenticate($level, $router);


?>


<div class="d-block w-100">
	<a href="<?= $router->urlPut('AdminPupilsSecondary')?>" class="btn btn-news float-right mr-2" >Liste des élèves</a>
</div>
<div class="d-block w-100 mt-5">

	<h3 align="center">Page d'édition des informations d'un apprenant</h3>
</div>

<?php


if ($forWho === 'parents') {

$oldPupil = (new Requestor(Pupil::class))->getContentsWithWhere('list_of_pupils', 'id', $id, 'name')[0];

$father_ok = Templates::setTheSecondIfFirstNotSet($_POST['father'] ?? '', $oldPupil->getFather());
$mother_ok = Templates::setTheSecondIfFirstNotSet($_POST['mother'] ?? '', $oldPupil->getMother());
$tutor_ok = Templates::setTheSecondIfFirstNotSet($_POST['tutor'] ?? '', $oldPupil->getTutor());
$phone_ok = Templates::setTheSecondIfFirstNotSet($_POST['phone'] ?? '', $oldPupil->getPhone());
$address_ok = Templates::setTheSecondIfFirstNotSet($_POST['address'] ?? '', $oldPupil->getAddress() ?? '');

$inputFather = new Form("Nom et Prénoms du Père", 'text', 'father', $father_ok, '');
$inputFather->setPlaceholder("Veuillez renseigner le nom et le prénoms du Père de élève svp...");

$inputMother = new Form("Nom et Prénoms de la mère", 'text', 'mother', $mother_ok, '');
$inputMother->setPlaceholder("Veuillez renseigner le nom et le prénoms de la mère de élève svp...");

$inputTutor = new Form("Nom et Prénoms du tuteur", 'text', 'tutor', $tutor_ok, '');
$inputTutor->setPlaceholder("Veuillez renseigner le nom et le prénoms du tuteur de élève svp...");


$inputPhone = new Form('Contact parents', 'tel', 'phone', $phone_ok, '');
$inputPhone->setPlaceholder("Veuillez renseigner le numéro de téléphone des parents de élève svp..");

$inputAddress = new Form('Adresse des parents', 'text', 'address', $address_ok, '');
$inputAddress->setPlaceholder("Veuillez renseigner addresse des parents de élève svp..");



$noErrors = true;
$errors = [];

if (!empty($_POST)) {

	$father = trim(htmlspecialchars($_POST['father']));
	$mother = trim(htmlspecialchars($_POST['mother']));
	$tutor = trim(htmlspecialchars($_POST['tutor']));
	$phone = trim(htmlspecialchars($_POST['phone']));
	$address = trim(htmlspecialchars($_POST['address']));

	$pupil = new Pupil();
	$pupil->setFather($father)
		  ->setMother($mother)
		  ->setTutor($tutor)
		  ->setPhone($phone)
		  ->setId($id)
		  ->setAddress($address);

	$validator = new PupilValidator($pupil);
	$errors = $validator->getParentErrors();
	$noErrors = empty($errors);
	if ($noErrors) {
		$pupil->updateThisPupilParentsInfo();
		header('Location:'.$router->urlPut('PupilProfil', ['id' => $id]));
	}

}



?>

<div class="insertor my-3">
	<form action="">
		<?php 

		Templates::inputMaker($inputFather, $father_ok ?? '', $errors, 'father');
		Templates::inputMaker($inputMother, $mother_ok ?? '', $errors, 'mother');
		Templates::inputMaker($inputTutor, $tutor_ok ?? '', $errors, 'tutor');
		Templates::inputMaker($inputAddress, $address_ok ?? '', $errors, 'address');
		Templates::inputMaker($inputPhone, $phone_ok ?? '', $errors, 'phone');

		?>

		<div class="m-auto w-75 justify-content-center row mt-4 pt-2">
			<button class="btn btn-primary mx-1 w-25">Soumettre</button>
			<a href="<?= $router->urlPut('AdminPupilsSecondary')?>" class="btn btn-news mx-1 w-25" >Annuler</a>
		</div> 
	</form>
</div>
<?php 
}



//LA PARTIE EDITION DES INFOS POUR ELEVE
elseif ($forWho === 'eleve') {

$oldPupil = (new Requestor(Pupil::class))->getContentsWithWhere('list_of_pupils', 'id', $id, 'name')[0];

$name_ok = Templates::setTheSecondIfFirstNotSet($_POST['name'] ?? '', $oldPupil->getName());
$surname_ok = Templates::setTheSecondIfFirstNotSet($_POST['surname'] ?? '', $oldPupil->getSurname());
$birthday_ok = Templates::setTheSecondIfFirstNotSet($_POST['birthday'] ?? '', $oldPupil->getBirthday());
$is_responsable_ok = Templates::setTheSecondIfFirstNotSet($_POST['is_responsable'] ?? '', $oldPupil->getIsResponsable());
$sexe_ok = Templates::setTheSecondIfFirstNotSet($_POST['sexe'] ?? '', $oldPupil->getSexe());
$classe_ok = Templates::setTheSecondIfFirstNotSet($_POST['classe'] ?? '', $oldPupil->getClasse());

$inputName = new Form("Nom de l'élève", 'text', 'name', $name_ok, '');
$inputName->setPlaceholder("Veuillez renseigner le nom de élève svp...");

$inputSurname = new Form("Prénoms de l'élève", 'text', 'surname', $surname_ok, '');
$inputSurname->setPlaceholder("Veuillez renseigner les prénoms de élève svp...");

$inputClasse = new Form('Classe', 'text', 'classe', '', '');

$inputSexe = new Form('Sexe', 'radio', 'sexe', '', '');
$inputIsResponsable = new Form('Responsable de classe', 'radio', 'is_responsable', '', '');


$inputBirth = new Form('Date de naissance', 'date', 'birthday', $birthday_ok, '');

//Recuperation de toutes les classes disponibles
$allClasses = (new Requestor(Classe::class))->getContentsWithWhere('list_of_classes', 'level', $level, 'classe');

//Insertion des différentes classes recupérées sous forme de tableau
$tableOfClasses = [];
foreach ($allClasses as $c) {
	$tableOfClasses[] = $c->getClasse();
}


$noErrors = true;
$errors = [];

if (!empty($_POST)) {


	$name = trim(htmlspecialchars($_POST['name']));
	$surname = trim(htmlspecialchars($_POST['surname']));
	$classe = trim(htmlspecialchars($_POST['classe']));
	$sexe = trim(htmlspecialchars($_POST['sexe']));
	$is_responsable = trim(htmlspecialchars($_POST['is_responsable']));
	$birthday = trim(htmlspecialchars($_POST['birthday']));

	$pupil = new Pupil();
	$pupil->setName($name)
		  ->setId($id)
		  ->setSurname($surname)
		  ->setClasse($classe)
		  ->setSexe($sexe)
		  ->setBirthday($birthday)
		  ->setIsResponsable($is_responsable);
	$validator = new PupilValidator($pupil);
	$errors = $validator->getPupilErrors();
	$noErrors = empty($errors);	  
	if ($noErrors) {
		$is_responsable = $pupil->updateThisPupilInfo();
		if ($is_responsable == 1) {
			$pupil->updateResponsableStatus();
		}
		header('Location:'.$router->urlPut('PupilProfil', ['id' => $id]));
	}

}

?>
<div class="insertor my-3">
	<form action="" method="post">
		<?php 

		
		Templates::inputMaker($inputName, $name_ok ?? '', $errors, 'name');
		Templates::inputMaker($inputSurname, $surname_ok ?? '', $errors, 'surname');
		Templates::inputMakerForSelect($inputClasse, $tableOfClasses, $classe_ok ?? '', $errors, 'classe');
		Templates::inputMakerForRadio($inputSexe, ['Masculin', 'Feminin'], $sexe_ok ?? '', $errors, 'sexe');
		Templates::inputMakerForRadio($inputIsResponsable, ['Oui', 'Non'], $is_responsable_ok ?? '', $errors, 'is_responsable');
		Templates::inputMaker($inputBirth, $birthday ?? '', $errors, 'birthday');

		?>

		<div class="m-auto w-75 justify-content-center row mt-4 pt-2">
			<button class="btn btn-primary mx-1 w-25">Soumettre</button>
			<a href="<?= $router->urlPut('PupilProfil', ['id' => $id])?>" class="btn btn-news mx-1 w-25" >Annuler</a>
		</div> 
	</form>
</div>

<?php
}else{
	header('Location:'.$router->urlPut('AdminPupils'));
}

?>