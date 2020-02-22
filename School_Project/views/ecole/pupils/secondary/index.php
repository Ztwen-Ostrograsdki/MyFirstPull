<?php 

use MyFramework\Auth\URLAuth\URLAuth;
use MyFramework\Classe\Classe;
use MyFramework\SqlRequests\Requestor;


//Recuperation de toutes les classes disponibles
$allClasses = (new Requestor(Classe::class))->getContentsWithWhere('list_of_classes', 'level', 'secondaire', 'classe');

// dump($allClasses);die;
//Insertion des différentes classes recupérées sous forme de tableau
$tableOfClasses = [];
foreach ($allClasses as $c) {
	$tableOfClasses[] = $c->getClasse();
}


?>

<div>
	<a href="<?= $router->urlPut('NewPupil', ['level' => 'secondaire'])?>" class="btn btn-news float-right mr-2" >Ajouter in nouvel élève</a>
	<h3 class="ml-2">Les élèves du secondaire</h3>
	
	<div class="mt-5 p-2">
		<div class="row m-auto w-100 justify-content-center">
		<?php  foreach ($allClasses as $c) {?>
			<a href=" <?= $router->urlPut('AdminPupilsSecondaryList', ['classe' => $c->getClasse()]) ?>" class="btn-news btn mt-1 w-23 d-inline-block mx-1"><?= $c->getClasse() ?></a>
		<?php } ?>	
		</div>
	</div>
	
</div>