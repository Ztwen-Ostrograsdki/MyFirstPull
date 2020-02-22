<?php 

use MyFramework\Auth\URLAuth\URLAuth;
use MyFramework\Discipline\NewDiscipline;
use MyFramework\HTMLFormat\Form;
use MyFramework\Helpers\Templates\Templates;
use MyFramework\Validators\DisciplineValidator\N_DisciplineValidator;

$inputName = new Form("Nom de la discipline", 'text', 'name', '', '');
$inputName->setPlaceholder('Veuillez renseigner le nom de la discipline svp...');


$errors = [];
$norrors = true;
$level = htmlspecialchars($params['level']);

URLAuth::urlLevelAuthenticate($level, $router);
if (!empty($_GET)) {
	$name = ucfirst(trim(htmlspecialchars($_GET['name'])));

	$discipline = new NewDiscipline($name, $level);
	$validator = new N_DisciplineValidator($discipline);
	$errors = $validator->getErrors();
	$norrors = empty($errors);

	if ($norrors) {
		$hisID = $discipline->insertIntoTableOfDisciplines();
		header('Location:'.$router->urlPut('NewDiscipline'));
	}

}



?>

<div class="mt-5">
	<div class="m-3">
		<h3 align="center">Mise en place d'une nouvelle discipline</h3>
	</div>

	<div class="insertor my-4">
		<form action="">
			<?php 
				
				Templates::inputMaker($inputName, $name ?? '', $errors, 'name');

			?>
			<div class="m-auto w-25">
				<button class="btn btn-primary w-100 mt-2">Valider</button>
			</div> 
		</form>
	</div>
</div>