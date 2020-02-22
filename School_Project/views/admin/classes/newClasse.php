<?php 

use MyFramework\Auth\URLAuth\URLAuth;
use MyFramework\Classe\NewClasse;
use MyFramework\HTMLFormat\Form;
use MyFramework\Validators\ClasseValidator\N_ClasseValidator;

$inputName = new Form("Nom de la classe", 'text', 'name', '', '');
$inputName->setPlaceholder('Veuillez renseigner le nom de la classe svp...');

$errors = [];
$norrors = true;
$level = htmlspecialchars($params['level']);

URLAuth::urlLevelAuthenticate($level, $router);
if (!empty($_GET)) {
	$name = trim(htmlspecialchars($_GET['name']));

	$classe = new NewClasse($name, $level);
	$validator = new N_ClasseValidator($classe);
	$errors = $validator->getErrors();
	$norrors = $validator->theyAreAnyErrors();
	if ($norrors) {
		$hisID = $classe->insertIntoTableOfClasses();
		header('Location:'.$router->urlPut('NewClasse', ['level' => $level]));
	}

	
	
}



?>

<div>
	<h3 align="center">Mise en place d'une nouvelle salle de classe</h3>
</div>

<div class="insertor my-3">
	<form action="">
		<?php 
		$inputName->errors = $errors['name'] ?? '';
		if(isset($errors['name']) AND $errors['name'] !== null) {
            $inputName->classListAdvanced = 'form-control input-danger is-invalid';
        }
        if(isset($name) AND $errors !== []) {
            $inputName->setValue($name);
        }
		echo $inputName->advancedSetInput(70);
		echo $inputName->invalidCustomFeedBack($inputName->errors);

		?>
		<div class="m-auto w-25">
			<button class="btn btn-primary w-100 mt-2">Valider</button>
		</div> 
	</form>
</div>