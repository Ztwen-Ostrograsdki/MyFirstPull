<?php 

use MyFramework\Helpers\Templates\Templates;
use MyFramework\PupilsInfos\Pupil\Pupil;
use MyFramework\SqlRequests\Requestor;

$id = (int)$params['id'];
$pupil = (new Requestor(Pupil::class))->getContentsWithWhere('list_of_pupils', 'id', $id, 'name' )[0];

?>

<div class="container-profil m-0 p-0">
	<div class="row justify-content-between w-100 m-0 p-0">
		<div class="profil-img">
			<h3>Profil de <?= $pupil->getName() ." ".$pupil->getSurname() ?></h3>
			<span><img src="/media/hideface.jpg" alt="" width="250"></span>
		</div>
		<div class="profil-school">
			<h3>COMPLEXE SCOLAIRE BILINGUE</h3>
			<h2 align="center" class="profil-class">2<small>nde</small> C</h2>
		</div>
		<div class="profil-admin">
			<div class="justify-content-center">
				<a href="#" class="btn btn-news d-block mt-1"> Consulter les notes du 1er Trimestre</a>
				<a href="#" class="btn btn-news d-block mt-1"> Consulter les notes du 2eme Trimestre</a>
				<a href="#" class="btn btn-news d-block mt-1"> Consulter les notes du 3eme Trimestre</a>
			</div>
		</div>
	</div>
	<div class="mt-2">
		<div class="row justify-content-center">
			<div class="onetable">
				<h5>Les infos personelles</h5>
				<table class="table-profil ">
					<tr>
						<td>Nom:</td>
						<td> <?= $pupil->getName() ?> </td>
					</tr>
					<tr>
						<td>Prénoms:</td>
						<td><?= $pupil->getSurname() ?></td>
					</tr>
					<tr>
						<td>Date de Naissance:</td>
						<td><?= $pupil->getFormattedBirthday() ?></td>
					</tr>
					<tr>
						<td>Age:</td>
						<td><?= $pupil->getAge() ?></td>
					</tr>
					<tr>
						<td>Sexe:</td>
						<td><?= $pupil->getSexe() ?></td>
					</tr>
					<tr>
						<td>Classe:</td>
						<td><?= $pupil->getClasse() ?></td>
					</tr>
				</table>
				<span>
					<a href=" <?= $router->urlPut('AdminPupilInfos', ['level' => $pupil->getLevel(), 'forWho' => 'eleve', 'id' => $pupil->getId()]) ?> " class="btn btn-news my-1 p-1 float-right">Mettre à jour</a>
				</span>
			</div>
			<div class="onetable">
				<h5>Les infos parentales</h5>
				<table class="table-profil ">
					<tr>
						<td>Père :</td>
						<td><?= $pupil->getFather() ?></td>
					</tr>	
					<tr>
						<td>Mère :</td>
						<td><?= $pupil->getMother() ?></td>
					</tr>	
					<tr>
						<td>Tuteur :</td>
						<td><?= $pupil->getTutor() ?></td>
					</tr>
					<tr>
						<td>Contacts parents :</td>
						<td><?= $pupil->getPhone() ?></td>
					</tr>
					<tr>
						<td>Adresse :</td>
						<td><?= Templates::setTheSecondIfFirstNotSet($pupil->getAddress(), 'inconnue' )?></td>
					</tr>
				</table>
				<span>
					<a href=" <?= $router->urlPut('AdminPupilInfos', ['level' => $pupil->getLevel(), 'forWho' => 'parents', 'id' => $pupil->getId()]) ?> " class="btn btn-news my-1 p-1 float-right">Mettre à jour</a>
				</span>
			</div>
			<div class="onetable">
				<h5>Les détails scolaires</h5>
				<table class="table-profil ">

					<tr>
						<td>Moyenne 1er Trimestre :</td>
						<td>15</td>
					</tr>
					<tr>
						<td>Moyenne 2eme Trimestre :</td>
						<td>14.55</td>
					</tr>
					<tr>
						<td>Moyenne 3eme Trimestre :</td>
						<td>16.05</td>
					</tr>
					<tr>
						<td>Moyenne Générale :</td>
						<td>15.55</td>
					</tr>
					<tr>
						<td>Observation :</td>
						<td>Bonne</td>
					</tr>
				</table>
				<span>
					<a href="#" class="btn btn-news my-1 p-1 float-right">Mettre à jour</a>
				</span>
			</div>

		</div>
	</div>
</div>