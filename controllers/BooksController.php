<?php
// класс - модель для работы с книгами
	
Class  BooksController extends Controller{	
	
	
	public function search(){
	

		if( $books = $this->loadModel('Books') ){
		
			$q = $_GET['q'];
			
			$books = $books->search($q);
	
		}else{
			$books =[];
		}
	
		return $this->render('index', ['data'=>$books]);
		
	}	
	
	public function index(){
	

		if( $books = $this->loadModel('Books') ){
		
			$books = $books->findAll();
	
		}else{
			$books =[];
		}
	
		return $this->render('index', ['data'=>$books]);
		
	}
		
	 // удаление книги
	public function delete(){
			
			$id = isset($_GET['id']) ? (int) $_GET['id'] : '';
			
			if($book = $this->loadModel('Books') ){
				
				if( $id && $book->delete($id) ){
			
					$res['info'] = 'Данные успешно удалены!';
				
				}else{
					$res['info'] = 'Ошибка при удалении!';
				}
				//echo $res['info']; exit;
			
			}
			return $this->redirect('/books');
	
	} 	

	// обновление книги
	public function update(){
			
			$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
			
			$params = $_POST;
			$info = '';
			
			if( $book_model = $this->loadModel('Books') ){
				
				$book = $book_model->find($id);
				
				// print_r($book); exit;
				
				// получение id и чтение модели , обновление модели
				if(  $book_model->update($id, $params) ){
			
					$info = 'Данные успешно обновлены!';
				
					return $this->redirect('/books/update?id='.$id);
				}else{
					$info = 'Ошибка при обновлении!';
				}
			}
		
			return $this->render('form', [
				'book' => $book,
				'info' => $info,
			]);
	
	} 
	// добавление книги
	public function create(){
			
			$params = $_POST;
			$res['info'] = '';
			
			if( $book = $this->loadModel('Books') ){

		
				if( $book_id = $book->create($params) ){
				
					$res['info'] = 'Данные успешно сохранены!';
					
					return $this->redirect('/books/update?id=' . $book_id);

				}else{
					$res['info'] = 'Ошибка при создании!';
					//echo $res['info'] ;
				}				
			
				
			}
			
			return $this->render('form', $res);
	
	} 
		
	// добавление автора в книгу
	public function addauthor(){
			
			$book_id = isset($_GET['id']) ? (int)$_GET['id'] : '';
			
			
			if( $author = $this->loadModel('Authors') ){
				
				$authors = $author->findAll();
			
				//  все авторы/соавторы книги
				$book_authors =  $author->getBookAuthors($book_id);
				
				$params = $_POST;
				if(isset($params['authors'])){
					// удаляем старых авторов
					$author->removeAuthorsFromBook($book_id);
					foreach($params['authors'] as $author_id ){
						// добавление всех выбранных авторов к данной книге
						$author->insertAuthorToBook($book_id, $author_id) ;
						
					}	
						
					return $this->redirect('/books/addauthor?id=' . $book_id);
						
				}
			}else{
				$authors = [];
			}		
			
			return $this->render('add-author', [
				'authors' => $authors,
				'book_authors' => $book_authors,
			]);
	
	} 		
		
	// получение книги по имени автора
	public function getBooksByAuthorName($author){
	
			// $title =  mysqli_real_escape_string( htmlspecialchars($_POST['author']) );
			$author = mysqli_real_escape_string( htmlspecialchars($author) );

			$query = "SELECT * FROM `books` WHERE id='{$book_id}'";
			if($res = mysqli_query($this->connect,$query) ){
				$query = "INSERT INTO `books_authors` (`book_id`,`author_id`) VALUES ('{$book_id}','{$author_id}')";
				mysqli_query($this->connect,$query);
				
				header('location: /update?book_id=' . $book_id );
			}			

			header('location: /books' );
	
	
	}
	
	// получение книг по именам авторов 
	public function getBooksByAuthorsNames(){
	
			$authors = $_POST['authors'];
		
			if(count($authors)>0){ // если более 1
				$where = ' WHERE ';
				foreach($authors as $author){
					$where .= " (authors.firstname like '%{$author}%' OR  authors.lastname like '%{$author}%') OR";
				}
				$where = trim($where,'OR'); // удалить крайний
			}else{
				$where = '';
			}
		
			$query = "SELECT books.*, authors.firstname, authors.lastname FROM books 
							INNER JOIN books_authors ON books.id=books_authors.book_id 
							INNER JOIN authors ON books_authors.author_id=authors.id 
							{$where}";
			
			if($res = mysqli_query($this->connect,$query) ){
				$rows_count = mysqli_num_rows($res); // кол-во записей в таблице
				while($row = mysqli_fetch_assoc($res)){
					$arr[] = $row;
				}
				
			}else{
				$arr = '';
			}

			return [ 
				'template' => 'index',
				'data' => $arr,			
			];
		
	}
	
	
}	