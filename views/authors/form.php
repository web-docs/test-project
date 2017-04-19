<?php /*
<?php $title = isset($book)? 'Обновление автора': 'Создание автора' ?>

<h3><?=$title?></h3>


<form method="post">

	<label>Имя</label>
	<input type="text" name="firstname" required value="<?= isset($author) ? $author['firstname'] : '' ?>">	
	<br><br>
	<label>Фамилия</label>
	<input type="text" name="lastname" required value="<?= isset($author) ? $author['lastname'] : '' ?>">	
	<br><br>
	
	<button name="submit">Сохранить</button>

</form> */ ?>

<main>
	<div class="container">
	<h3><?=$title?></h3>
		<form method="post" class="form-inline">
			<label>Автор</label>
			<div class="form-group">
				<label>Имя</label>
				<input class="form-control" id="exampleInputName2" name="firstname" value="<?= isset($author) ? $author['firstname'] : '' ?>" required>	
			</div>
			<div class="form-group">
				<label>Фамилия</label>
				<input class="form-control" id="exampleInputName2" type="text" name="lastname" value="<?= isset($author) ? $author['lastname'] : '' ?>" required>	
			</div>
			<button  class="btn btn-default" type="submit" name="submit">Сохранить</button>
		</form>
	</div>
</main>