
<?php 

?>


<h3>
    Le MENU
</h3>
<div class="w-100">
	<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dolores ad soluta distinctio, saepe mollitia esse architecto corporis doloribus laudantium ea veniam deserunt perspiciatis quas vero minus reiciendis, harum cumque.
	</p>
	<div class="m-auto w-100">
		<div class="m-auto d-table w-50">
			<a href=" <?= $router->urlPut('MainTeachers') ?> " class="btn-news btn mt-1 w-100 d-block">Parcourir la liste des enseignants</a>
			<a href="  <?= $router->urlPut('MainClasses') ?>  " class="btn-news btn mt-1 w-100 d-block">Parcourir la liste des classes disponibles</a>
			<a href="<?= $router->urlPut('MainDisciplines') ?> " class="btn-news btn mt-1 w-100 d-block">Parcourir la liste des matières enseignées</a>
			<a href="<?= $router->urlPut('MainExams') ?>" class="btn-news btn mt-1 w-100 d-block">Voir les tendances aux examens passés</a>
			<a href="<?= $router->urlPut('MainExams') ?>" class="btn-news btn mt-1 w-100 d-block">Voir les résultats aux examens</a>
		</div>
	</div>
</div>
