<?php
// класс - модель для работы с книгами

Class  AuthorsController extends Controller{	
	
	public function index(){
	

		if( $author = $this->loadModel('Authors') ){
		
			$authors = $author->findAll();
	
		}else{
			$authors =[];
		}
	
		return $this->render('index', [
			'data'=>$authors
		]);
		
	}
		
	 // удаление 
	public function delete(){
			
			$id = isset($_GET['id']) ? (int) $_GET['id'] : '';
			
			if($author = $this->loadModel('Authors') ){
				
				if( $id && $author->delete($id) ){
			
					$res['info'] = 'Данные успешно удалены!';
				
				}else{
					$res['info'] = 'Ошибка при удалении!';
				}
			
			}
			return $this->redirect('/authors');
	
	} 	

	// обновление 
	public function update(){
			
			$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
			
			$params = $_POST;
			$info = '';
			
			if( $author_model = $this->loadModel('Authors') ){
				
				$author = $author_model->find($id);
				
				// print_r($book); exit;
				
				// получение id и чтение модели , обновление модели
				if(  $author_model->update($id, $params) ){
			
					// $info = 'Данные успешно обновлены!';
				
					return $this->redirect('/authors/update?id='.$id);
				}else{
					$info = 'Ошибка при обновлении!';
				}
			}
		
			return $this->render('form', [
				'author' => $author,
				'info' => $info,
			]);
	
	} 
	// добавление 
	public function create(){
			
			$params = $_POST;
			$res['info'] = '';
			
			if( $book = $this->loadModel('Authors') ){
		
				if( $author_id = $book->create($params) ){
				
					//$res['info'] = 'Данные успешно сохранены!';
					
					return $this->redirect('/authors/update?id=' . $author_id);

				}else{
					$res['info'] = 'Ошибка при создании!';
				}	
							
			}
			
			return $this->render('form', $res);
	
	} 
	
	
	
	// удаление автора из книги
	public function removeAuthorFromBook( $book_id, $autor_id){
			
			$query = "DELETE FROM `books_authors` WHERE `book_id`='{$book_id}' AND `author_id`='{$author_id}'";			
			if($res = mysqli_query($this->connect,$query) ){
				return true;
			}			
			return false;

	
	} 
	
	// добавление автора в книгу
	public function addtobook(){
			
			$author_id = isset($_GET['id']) ? (int)$_GET['id'] : '';
			
			
			if( $book = $this->loadModel('Books') ){
				
				$books = $book->findAllBooks();
				$author = $this->loadModel('Authors');
				//  все авторы/соавторы книги
				$book_authors =  $author->getAuthorBooks($author_id);
				
				$params = $_POST;
				
				//print_r($book_authors);exit;
				
				if(isset($params['books'])){
					// удаляем старых авторов
					$author->removeBooksFromAuthor($author_id);
					foreach($params['books'] as $book_id ){
						// добавление всех выбранных книг к данному автору
						$author->insertAuthorToBook($book_id, $author_id) ;
						//echo $book_id . ' ';
					}	
						//exit;
					return $this->redirect('/authors/addtobook?id=' . $author_id);
						
				}
			}else{
				$books = [];
			}		
			
			return $this->render('add-book', [
				'author' => $author->find($author_id),
				'books' => $books,
				'book_authors' => $book_authors,
			]);
	
	} 		
	


	
	
}	