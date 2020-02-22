<?php 


?>

<h3 class="form-control">
    Listes des classes disponibles
</h3>
<div class="w-100 mb-3">
	<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dolores ad soluta distinctio, saepe mollitia esse architecto corporis doloribus laudantium ea veniam deserunt perspiciatis quas vero minus reiciendis, harum cumque.
	</p>
	<div class="m-auto w-100">
		<div class="m-auto d-table w-50">
			
			<a href=" <?= $router->urlPut('MainClassesPrimary') ?> " class="btn-news btn mt-1 w-100 d-block">Le primaire</a>
			<a href=" <?= $router->urlPut('MainClassesSecondary') ?> " class="btn-news btn mt-1 w-100 d-block">Le secondaire (Premier cycle - second cycle)</a>
			
		</div>
	</div>
</div>
