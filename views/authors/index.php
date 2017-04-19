<?php 

if(isset($info)){ ?>

	<div>	
		<?=$info?>
	</div>

<?php }  ?>


<main>
	<div class="container">
			<?php 
echo '<h2>Список авторов</h2>';


if( isset($data) ){  ?>
<table class="table table-striped">
<tr>
	<td>id</td>
	<td>Название</td>
	<td>Автор(ы)</td>
	<td></td>
</tr>	
<?php
//echo '<pre>';print_r($data);

foreach($data as $key=>$row){ ?>
	<tr>
		<td><?=$row['id']?></td>
		<td><?=$row['firstname']?></td>		
		<td><?=$row['lastname']?></td>		
		<td>			
			<a href="/authors/update?id=<?=$row['id']?>" title="Изменить">
				<span class="glyphicon glyphicon-pencil"></span>
			</a>
			<a href="/authors/delete?id=<?=$row['id']?>" title="Удалить">
				<span class="glyphicon glyphicon-remove"></span>
			</a>
			<a href="/authors/addtobook?id=<?=$row['id']?>" title="Добавить к книге">
				<span class="glyphicon glyphicon-plus-sign"></span>
			</a>
		</td>
		
		
	</tr>		
<?php } ?>

</table>

<?php }else{ ?>
<p>Нет данных для отображения</p>
<?php } ?>
	</div>
</main>
