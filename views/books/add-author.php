<main>
	<div class="container">
		<div class="table-responsive">
		
		<form method="post">
			<table class="table">
<tr>
	<td>id</td>
	<td>Выберите авторов</td>
</tr>	

	<?php 
if(isset($authors))	{
	foreach( $authors as $author ){ ?>
	<tr>
		<td><?=$author['id']?></td>
		<td>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="authors[]" value="<?=$author['id']?>" <?= in_array($author['id'],$book_authors) ? 'checked' :'' ?>> <?=$author['firstname'] . ' ' .$author['lastname']?>
				</label>
			</div>
		</td>
		<td>

		</td>
	</tr>
	<?php } 	
}	?>	
	</table>
	<button  class="btn btn-default" type="submit" name="submit">Сохранить</button>
	</form>
	
	</div>
</div>
</main>