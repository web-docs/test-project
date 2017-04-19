<main>
	<div class="container">
		<div class="table-responsive">
		
	<form method="post">
		<table class="table">
			<tr>
				<td>id</td>
				<td>Выберите книги для автора <?= $author['firstname'] . ' ' . $author['lastname'] ?></td>
			</tr>	

<?php if(isset($books)){

	foreach( $books as $book ){ ?>
	<tr>
		<td><?=$book['id']?></td>
		<td>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="books[]" value="<?=$book['id']?>" <?= in_array($book['id'],$book_authors) ? 'checked' :'' ?>> <?=$book['title'] ?>
				</label>
			</div>
		</td>
		<td>

		</td>
	</tr>
	<?php } 
	
} ?>	
		</table>
		<button  class="btn btn-default" type="submit" name="submit">Сохранить</button>
	</form>
	
	</div>
</div>
</main>