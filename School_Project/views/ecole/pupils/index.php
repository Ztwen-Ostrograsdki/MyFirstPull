<?php 



?>


<div>
<h3>Liste des élèves de l'établissement</h3>
	
	<div class="m-auto w-100">
		<div class="m-auto d-table w-50">
			
			<a href=" <?= $router->urlPut('AdminPupilsPrimary') ?> " class="btn-news btn mt-1 w-100 d-block">Le primaire</a>
			<a href=" <?= $router->urlPut('AdminPupilsSecondary') ?>" class="btn-news btn mt-1 w-100 d-block">Le secondaire (Premier cycle - second cycle)</a>
			
		</div>
	</div>
</div>