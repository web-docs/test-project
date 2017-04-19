<?php 

if(isset($info)){ ?>

	<div>	
		<?=$info?>
	</div>

<?php }  ?>

<main>
	<div class="container">
			 
<h2>Список книг</h2>

<?php if(isset( $data) ) { ?>

<table class="table table-striped">
<tr>
	<td>id</td>
	<td>Название</td>
	<td>Автор(ы)</td>
	<td></td>
</tr>	
<?php 

foreach($data as $key=>$row){ ?>
	<tr>
		<td><?=$row['id']?></td>
		<td><?=$row['title']?></td>
		<td>
		<?php if(isset($row['firstname']) ) echo $row['firstname'] . ' ' . $row['lastname']?>
		<?php 
		if(isset($row['authors'])){
			foreach($row['authors'] as $author){  
				echo $author .'<br>';			
			} 
		}
		?>	
		</td>	
		<td>			
			<a href="/books/update?id=<?=$row['id']?>" title="Изменить">
				<span class="glyphicon glyphicon-pencil"></span>
			</a>
			<a href="/books/delete?id=<?=$row['id']?>" title="Удалить">
				<span class="glyphicon glyphicon-remove"></span>
			</a>
			<a href="/books/addauthor?id=<?=$row['id']?>" title="Добавить автора">
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
