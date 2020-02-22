<?php 

use MyFramework\PupilsInfos\Pupil\Pupil;
use MyFramework\SqlRequests\Requestor;

$classe = urldecode(htmlspecialchars($params['classe']));
$pupils = (new Requestor(Pupil::class))->getContentsWithWhere('list_of_pupils', 'classe', $classe, 'name' );

?>


<div class="w-100">
	<h3>Les élèves de la classe de la <?= $classe ?> </h3>
</div>
<div class=" w-100 m-2 row justify-content-center">
	<a href="#" class="btn btn-news mx-1 mt-1"> Consulter les moyennes du 1er Trimestre</a>
	<a href="#" class="btn btn-news mx-1 mt-1"> Consulter les moyennes du 2eme Trimestre</a>
	<a href="#" class="btn btn-news mx-1 mt-1"> Consulter les moyennes du 3eme Trimestre</a>
</div>
<div class="w-100">
	<table class="table-table table-striped" class="w-100">
		<thead class="w-100">
			<th class="py-1">No</th>
			<th>Nom</th>
			<th>Prénoms</th>
			<th>Moy 1er Trim</th>
			<th>Moy 2eme Trim</th>
			<th>Moy 3eme Trim</th>
			<th>Actions</th>
		</thead>
		<tbody>
			<?php $i = 0; foreach($pupils as $pupil){ $i++;?>
			<tr class="py-1">
				<td><?= $i; ?></td>
				<td>
					<a href= "<?= $router->urlPut('PupilProfil', ['id' => $pupil->getId()]) ?>" class="w-100"> <?= $pupil->getName() ?> </a>
				</td>
				<td>
					<a href=" <?= $router->urlPut('PupilProfil', ['id' => $pupil->getId()]) ?> " class="w-100"><?= $pupil->getSurname() ?></a>
				</td>
				<td>
					<a href="#" class="w-100">15</a>
				</td>
				<td>
					<a href="#" class="w-100">14.55</a>
				</td>
				<td>
					<a href="#" class="w-100">14.55</a>
				</td>
				<td>
					<a href="#" class="btn btn-info  w-100">
						Editer
					</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>