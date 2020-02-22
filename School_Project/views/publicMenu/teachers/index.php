<?php 


?>

<h3 class="form-control">
    Listes des enseignats par matieres
</h3>
<div class="w-100 mb-3">
	<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dolores ad soluta distinctio, saepe mollitia esse architecto corporis doloribus laudantium ea veniam deserunt perspiciatis quas vero minus reiciendis, harum cumque.
	</p>
	<div class="m-auto w-100">
		<div class="m-auto d-table w-50">
			<a href=" <?= $router->urlPut('MainTeachersByDiscipline', ['discipline' => 'Mathematique']) ?> " class="btn-news btn mt-1 w-100 d-block">Les enseignants des Mathématiques</a>
			<a href="<?= $router->urlPut('MainTeachersByDiscipline', ['discipline' => 'pct']) ?> " class="btn-news btn mt-1 w-100 d-block">Les enseignants des PCT</a>
			<a href="<?= $router->urlPut('MainTeachersByDiscipline', ['discipline' => 'svt']) ?> " class="btn-news btn mt-1 w-100 d-block">Les enseignants des SVT</a>
			<a href="#" class="btn-news btn mt-1 w-100 d-block">Les enseignants d'Anglais</a>
			<a href="#" class="btn-news btn mt-1 w-100 d-block">Les enseignants de Français</a>
			<a href="#" class="btn-news btn mt-1 w-100 d-block">Les enseignants des Histoire-Géographie</a>
			<a href="#" class="btn-news btn mt-1 w-100 d-block">Les enseignants des Philosophie</a>
			<a href="#" class="btn-news btn mt-1 w-100 d-block">Les enseignants des Sport</a>
			
		</div>
	</div>
</div>
