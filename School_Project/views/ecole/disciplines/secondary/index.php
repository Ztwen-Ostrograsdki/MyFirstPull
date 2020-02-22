<?php 


?>
<div class="w-100">
<h3 class="d-inline-block float-left ml-2">Les disciplines enseignées dans l'école section secondaire</h3>

	<a href=" <?= $router->urlPut('NewDiscipline', ['level' => 'secondaire']) ?> " class="btn btn-news float-right m-2" >Inserer une nouvelle discipline</a>
	<table class="table-table table-striped" class="w-100">
		<thead class="w-100">
			<th class="py-1">#ID</th>
			<th>Disciplines</th>
			<th>AE</th>
			<th>Nombres d'ensignants</th>
		</thead>
		<tbody>
			
			<tr class="py-1">
				<td>1</td>
				<td>
					<a href="#" class="w-100">Mathématiques</a>
				</td>
				<td>
					<a href="#" class="w-100">AHMED Julien</a>
				</td>
				<td>
					<a href="#" class="w-100">25</a>
				</td>
				
			</tr>
			<tr class="py-1">
				<td>2</td>
				<td>
					<a href="#" class="w-100">SVT</a>
				</td>
				<td>
					<a href="#" class="w-100">GIILOA Brice</a>
				</td>
				<td>
					<a href="#" class="w-100">28</a>
				</td>
			</tr>
			<tr class="py-1">
				<td>3</td>
				<td>
					<a href="#" class="w-100">Geographie</a>
				</td>
				<td>
					<a href="#" class="w-100">DAGALO Venance</a>
				</td>
				<td>
					<a href="#" class="w-100">40</a>
				</td>
				
			</tr>
		</tbody>
	</table>
</div>