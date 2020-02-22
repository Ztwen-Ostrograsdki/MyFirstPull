<?php 

use MyFramework\Auth\URLAuth\URLAuth;
use MyFramework\Classe\Classe;
use MyFramework\HTMLFormat\Form;
use MyFramework\Helpers\Templates\Templates;
use MyFramework\PupilsInfos\Pupil\Pupil;
use MyFramework\SqlRequests\Requestor;
use MyFramework\Teacher\Teacher;
use MyFramework\Validators\ClasseValidator\ClasseValidator;
use MyFramework\Validators\PupilValidator\PupilValidator;


$id = (int)$params['id'];
$level = htmlspecialchars($params['level']);

$classe = (new Requestor(Classe::class))->getContentsWithWhere('list_of_classes', 'id', $id, 'classe')[0];
$pupils = (new Requestor(Pupil::class))->getContentsWithWhere('list_of_pupils', 'classe', $classe->getClasse(), 'classe');


$tableOfPupils = [];
foreach ($pupils as $pupil) {
	$tableOfPupils[] = $pupil->getName()." ".$pupil->getSurname();
}


$teachers = (new Requestor(Teacher::class))->getContentsWithWhere('list_of_teachers', 'level', $level, 'name');
$tableOfTeachers = [];
foreach($teachers as $teacher){
	$hisClasses = $teacher->getClasses();

	if (in_array($classe->getClasse(), $hisClasses)) {
		$tableOfTeachers[] = $teacher->getName()." ".$teacher->getSurname();
	}
}

$principal_ok = Templates::setTheSecondIfFirstNotSet($_POST['classe'] ?? '', $classe->getPrincipal());
$responsable1_ok = Templates::setTheSecondIfFirstNotSet($_POST['responsable1'] ?? '', $classe->getResponsable1());
$responsable2_ok = Templates::setTheSecondIfFirstNotSet($_POST['responsable2'] ?? '', $classe->getResponsable2());
$name_ok = Templates::setTheSecondIfFirstNotSet($_POST['name'] ?? '', $classe->getClasse());
$inputName = new Form("Nom de la classe", 'text', 'name', $name_ok, '');
$inputName->setPlaceholder("Veuillez renseigner le nom de la classe svp...");

$inputResponsable1 = new Form('Premier responsable', 'text', 'responsable1', '', '');
$inputResponsable2 = new Form('Second responsable', 'text', 'responsable2', '', '');
$inputPrincipal = new Form('Le Professeur principal', 'text', 'principal', '', '');


$noErrors = true;
$errors = [];

if (!empty($_POST)) {

	$name = trim(htmlspecialchars($_POST['name']));
	$responsable1 = htmlspecialchars($_POST['responsable1']);
	$responsable2 = htmlspecialchars($_POST['responsable2']);
	$principal = htmlspecialchars($_POST['principal']);
	$c = new Classe();
	$c->setClasse($name)
	  ->setResponsable1($responsable1)
	  ->setResponsable2($responsable2)
	  ->setPrincipal($principal)
	  ->setId($id);
	$validator = new ClasseValidator($c);
	$errors = $validator->getErrors();
	$noErrors = empty($errors);
	if ($noErrors) {
		$c->updatethisClasse();
		header('Location:'.$router->urlPut('AdminClassesByLevel', ['level' => $level]));
	}

}

?>


<div class="d-block w-100 mt-5">

	<h3 align="center">Edition des informations de la classe de <?= $classe->getClasse() ?></h3>
</div>
<div class="insertor my-3">
	<form action="" method="post">
		<?php 

		
		Templates::inputMaker($inputName, $name_ok ?? '', $errors, 'name');
		Templates::inputMakerForSelect($inputResponsable1, $tableOfPupils, $responsable1_ok ?? '', $errors, 'responsable1');
		Templates::inputMakerForSelect($inputResponsable2, $tableOfPupils, $responsable2_ok ?? '', $errors, 'responsable');
		Templates::inputMakerForSelect($inputPrincipal, $tableOfTeachers, $principal_ok ?? '', $errors, 'principal');
		

		?>

		<div class="m-auto w-75 justify-content-center row mt-4 pt-2">
			<button class="btn btn-primary mx-1 w-25">Soumettre</button>
			<a href="<?= $router->urlPut('AdminClassesByLevel', ['level' => $level])?>" class="btn btn-news mx-1 w-25" >Annuler</a>
		</div> 
	</form>
</div>

