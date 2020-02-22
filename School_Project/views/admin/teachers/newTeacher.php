<?php 

use MyFramework\Auth\URLAuth\URLAuth;
use MyFramework\Classe\Classe;
use MyFramework\Discipline\Discipline;
use MyFramework\HTMLFormat\Form;
use MyFramework\Helpers\Templates\Templates;
use MyFramework\SqlRequests\Requestor;
use MyFramework\Teacher\NewTeacher;
use MyFramework\Validators\TeacherValidator\N_TeacherValidator;


$level = htmlspecialchars($params['level']);
URLAuth::urlLevelAuthenticate($level, $router);

$inputName = new Form("Nom de l'enseignant", 'text', 'name', '', '');
$inputName->setPlaceholder("Veuillez renseigner le nom du professeur svp...");

$inputSurname = new Form("Prénoms de l'enseignant", 'text', 'surname', '', '');
$inputSurname->setPlaceholder("Veuillez renseigner les prénoms du professeur svp...");

$inputClasses = new Form('Classe :', 'text', 'classes[]', '', '');

$inputSexe = new Form('Sexe', 'radio', 'sexe', '', '');

$inputDiscipline = new Form('Matières enseignée :', 'select', 'discipline', '', '');

$inputContact = new Form('Contact de l\'enseignant', 'tel', 'contact', '', '');
$inputContact->setPlaceholder("Veuillez renseigner le numéro du professeur svp..");

$inputAddress = new Form("Email de l'enseignant", 'email', 'address', '', '');
$inputAddress->setPlaceholder("Veuillez renseigner le mail du professeur svp...");

//Recuperation de toutes les classes disponibles
$allClasses = (new Requestor(Classe::class))->getContentsWithWhere('list_of_classes', 'level', $level, 'classe');
$allDisciplines = (new Requestor(Discipline::class))->getContentsWithWhere('list_of_disciplines', 'level', $level, 'discipline');

//Insertion des différentes classes recupérées sous forme de tableau
$tableOfClasses = [];
foreach ($allClasses as $c) {
	$tableOfClasses[] = $c->getClasse();
}

$tableOfDsciplines = [];
foreach ($allDisciplines as $d) {
	$tableOfDsciplines[] = $d->getDiscipline();
}



$noErrors = true;
$errors = [];

if (!empty($_GET)) {
	$name = trim(htmlspecialchars($_GET['name']));
	$surname = trim(htmlspecialchars($_GET['surname']));
	$discipline = trim(htmlspecialchars($_GET['discipline']));
	$sexe = trim(htmlspecialchars($_GET['sexe']));
	$contact = trim(htmlspecialchars($_GET['contact']));
	$address = trim(htmlspecialchars($_GET['address']));
	$classes = $_GET['classes'];
	

	$teacher = new NewTeacher($name, $surname, $level, $discipline, $sexe, (int)$contact, $address, $classes);
	$validator = new N_TeacherValidator($teacher);
	$errors = $validator->getErrors();
	$noErrors = empty($errors);
	
	if ($noErrors) {
		$teacher->insertThisTeacherIntoTable();
		header('Location:'.$router->urlPut('NewTeacher', ['level' => $level]));
	}
	

}



?>

<div>
	<h3 align="center">Insertion d'un nouvel enseignant</h3>
</div>

<div class="insertor my-3">
	<form action="">
		<?php 

		Templates::inputMaker($inputName, $name ?? '', $errors, 'name');
		Templates::inputMaker($inputSurname, $surname ?? '', $errors, 'surname');
		Templates::inputMaker($inputAddress, $address ?? '', $errors, 'address');
		Templates::inputMakerForSelect($inputDiscipline, $tableOfDsciplines, $discipline ?? '', $errors, 'discipline');
		Templates::inputMakerForRadio($inputSexe, ['Masculin', 'Feminin'], $sexe ?? '', $errors, 'sexe');
		Templates::inputMaker($inputContact, $contact ?? '', $errors, 'contact');
		Templates::inputMakerForMultiSelect($inputClasses, $tableOfClasses, $classes ?? [], $errors, 'classes');


		?>

		<div class="m-auto w-25">
			<button class="btn btn-primary w-100 mt-2">Soumettre</button>
		</div> 
	</form>
</div>