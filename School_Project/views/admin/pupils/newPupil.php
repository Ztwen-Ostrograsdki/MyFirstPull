<?php 

use MyFramework\Auth\URLAuth\URLAuth;
use MyFramework\Classe\Classe;
use MyFramework\HTMLFormat\Form;
use MyFramework\Helpers\Templates\Templates;
use MyFramework\PupilsInfos\Pupil\NewPupil;
use MyFramework\SqlRequests\Requestor;
use MyFramework\Validators\PupilValidator\N_PupilValidator;


$level = htmlspecialchars($params['level']);
URLAuth::urlLevelAuthenticate($level, $router);


$inputName = new Form("Nom de l'élève", 'text', 'name', '', '');
$inputName->setPlaceholder("Veuillez renseigner le nom de élève svp...");

$inputSurname = new Form("Prénoms de l'élève", 'text', 'surname', '', '');
$inputSurname->setPlaceholder("Veuillez renseigner les prénoms de élève svp...");

$inputFather = new Form("Nom et Prénoms du Père", 'text', 'father', '', '');
$inputFather->setPlaceholder("Veuillez renseigner le nom et le prénoms du Père de élève svp...");

$inputMother = new Form("Nom et Prénoms de la mère", 'text', 'mother', '', '');
$inputMother->setPlaceholder("Veuillez renseigner le nom et le prénoms de la mère de élève svp...");

$inputTutor = new Form("Nom et Prénoms du tuteur", 'text', 'tutor', '', '');
$inputTutor->setPlaceholder("Veuillez renseigner le nom et le prénoms du tuteur de élève svp...");

$inputClasse = new Form('Classe', 'text', 'classe', '', '');

$inputSexe = new Form('Sexe', 'radio', 'sexe', '', '');

$inputPhone = new Form('Contact parents', 'tel', 'phone', '', '');
$inputPhone->setPlaceholder("Veuillez renseigner le numéro de téléphone des parents de élève svp..");

$inputBirth = new Form('Date de naissance', 'date', 'birthday', '', '');

//Recuperation de toutes les classes disponibles
$allClasses = (new Requestor(Classe::class))->getContentsWithWhere('list_of_classes', 'level', $level, 'classe');

//Insertion des différentes classes recupérées sous forme de tableau
$tableOfClasses = [];
foreach ($allClasses as $c) {
	$tableOfClasses[] = $c->getClasse();
}


$noErrors = true;
$errors = [];

if (!empty($_GET)) {


	$name = trim(htmlspecialchars($_GET['name']));
	$surname = trim(htmlspecialchars($_GET['surname']));
	$classe = trim(htmlspecialchars($_GET['classe']));
	$father = trim(htmlspecialchars($_GET['father']));
	$mother = trim(htmlspecialchars($_GET['mother']));
	$tutor = trim(htmlspecialchars($_GET['tutor']));
	$sexe = trim(htmlspecialchars($_GET['sexe']));
	$phone = trim(htmlspecialchars($_GET['phone']));
	$birthday = trim(htmlspecialchars($_GET['birthday']));

	$pupil = new NewPupil($name, $surname, $birthday, $classe, $father, $mother, $tutor, $sexe, (int)$phone, $level);
	$validator = new N_PupilValidator($pupil);
	$errors = $validator->getErrors();
	$noErrors = empty($errors);
	if ($noErrors) {
		$hisID = $pupil->insertIntoTableOfPupils();
		header('Location:'.$router->urlPut('NewPupil', ['level' => $level]));
	}

}



?>

<div class="d-block w-100">
	<a href="<?= $router->urlPut('AdminPupilsSecondary')?>" class="btn btn-news float-right mr-2" >Liste des élèves</a>
</div>
<div class="d-block w-100 mt-5">

	<h3 align="center">Insertion d'un nouvel élève</h3>
</div>

<div class="insertor my-3">
	<form action="">
		<?php 

		Templates::inputMaker($inputName, $name ?? '', $errors, 'name');
		Templates::inputMaker($inputSurname, $surname ?? '', $errors, 'surname');
		Templates::inputMakerForSelect($inputClasse, $tableOfClasses, $classe ?? '', $errors, 'classe');
		Templates::inputMakerForRadio($inputSexe, ['Masculin', 'Feminin'], $sexe ?? '', $errors, 'sexe');
		Templates::inputMaker($inputFather, $father ?? '', $errors, 'father');
		Templates::inputMaker($inputMother, $mother ?? '', $errors, 'mother');
		Templates::inputMaker($inputTutor, $tutor ?? '', $errors, 'tutor');
		Templates::inputMaker($inputPhone, $phone ?? '', $errors, 'phone');
		Templates::inputMaker($inputBirth, $birthday ?? '', $errors, 'birthday');

		?>

		<div class="m-auto w-25">
			<button class="btn btn-primary w-100 mt-2">Soumettre</button>
		</div> 
	</form>
</div>