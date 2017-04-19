<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="/css/bootstrap.min.css" rel="stylesheet" />	
	<link href="/css/main.css" rel="stylesheet" />	
</head>
<body>
<header>
<nav class="navbar navbar-default">
	<div class="container-fluid">
<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">INTEGRATIC</a>
		</div>

<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li><a href="/books">Книги</a></li>
			<li><a href="/books/create" title="Добавить книгу"><span class="glyphicon glyphicon-plus-sign"></span></a></li>
			<li><a href="/authors">Авторы</a></li>
			<li><a href="/authors/create" title="Добавить автора"><span class="glyphicon glyphicon-plus-sign"></span></a></li>
			<li><a href="/main/parse" title="Парсинг json">Парсинг json</span></a></li>
			
		</ul>
		<div id="form-search">
		<form action="/books/search" class="navbar-form navbar-left" method="get">
			<div class="form-group">
				<input type="text" class="form-control" name="q" placeholder="Поиск">
			</div>
			<button type="submit" class="btn btn-default">Найти</button>
		</form>
		</div>
	</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
</header>
<main>
	<div class="container">
		<?=$content?>
	</div>
</main>

<script type="text/javascript" src="/js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
</body>
</html>
