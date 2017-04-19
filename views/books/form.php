
<?php $title = isset($book)? 'Обновление': 'Создание' ?>

<main>
	<div class="container">
	<h3><?=$title?></h3>
		<form method="post" class="form-inline">
			<div class="form-group">
				<label>Название</label>
				<input class="form-control" id="exampleInputName2" type="text" name="title" required value="<?= isset($book) ? $book['title'] : '' ?>">	
			</div>
			<button  class="btn btn-default" type="submit" name="submit">Сохранить</button>
		</form>
	</div>
</main>