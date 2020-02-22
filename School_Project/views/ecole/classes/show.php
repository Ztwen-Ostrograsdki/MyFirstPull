<?php 

use MyFramework\Classe\Classe;
use MyFramework\Helpers\Templates\Templates;
use MyFramework\PupilsInfos\Pupil\Pupil;
use MyFramework\SqlRequests\Requestor;

$level = $params['level'];

if ($level === 'primaire' || $level === 'secondaire') {

$respo = (new Requestor(Pupil::class))->getContentsWithWhere('list_of_pupils', 'is_responsable', 1, 'name')[0];
$classes = (new Requestor(Classe::class))->getContentsWithWhere('list_of_classes', 'level', $level, 'classe');


?>

<div>
	<h3 class="d-inline-block float-left ml-2">les classes disponibles au <?= ucfirst($level) ?></h3>
	<a href=" <?= $router->urlPut('NewClasse', ['level' => $level]) ?> " class="btn btn-news float-right m-2" > Inserer une nouvelle classe</a>
</div>

<div class="w-100">
	<table class="table-table table-striped" class="w-100">
		<thead class="w-100">
			<th class="py-1">#ID</th>
			<th>Classe</th>
			<th>Effectif</th>
			<th>1er Responsable</th>
			<th>2eme Responsable</th>
			<th>Prof Principal</th>
			<th>Actions</th>
		</thead>
		<tbody>
			
			<?php $i = 0; foreach($classes as $classe){ $i++;
				$respo1 = $classe->getResponsable1OnObject();
				$respo2 = $classe->getResponsable2OnObject();
				$idPrincipale = $classe->getPrincipalOnObject();
			?>
			<tr class="py-1">
				<td><?= $i ?></td>
				<td>
					<a href="#" class="w-100"><?= $classe->getClasse() ?></a>
				</td>
				<td><?= $classe->getEffectif() ?></td>
				<td>
					<a href=" <?php if($respo1 !== null){echo $router->urlPut('PupilProfil', ['id' => $respo1->getId()]);}else{echo "#";} ?> " class="w-100"> <?= Templates::setTheSecondIfFirstNotSet($classe->getResponsable1(), 'inconnue' )?></a>
				</td>
				<td>
					<a href=" <?php if($respo2 !== null){echo $router->urlPut('PupilProfil', ['id' => $respo2->getId()]);}else{echo "#";} ?> " class="w-100"><?= Templates::setTheSecondIfFirstNotSet($classe->getResponsable2(), 'inconnue' )?></a>
				</td>
				<td>
					<a href="#" class="w-100"><?= Templates::setTheSecondIfFirstNotSet($classe->getPrincipal(), 'inconnue' )?></a>
				</td>
				<td>
					<a href="<?= $router->urlPut('AdminClassesEdited', ['level' => $classe->getLevel(), 'id' => $classe->getId()]) ?>" class="btn btn-news  w-100">
						Editer
					</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php }else{
	header('Location:'.$router->urlPut('AdminClasses'));
	} ?>