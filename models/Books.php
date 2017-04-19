<?php
// класс - модель для работы с книгами
	
Class  Books extends Model{	
	
	
	// обновление книги
	public function update($book_id, $params){
			
			// признак того, что пользователь нажал на кнопку сохранить
			if(!isset($params['submit'])) return false;
			
			$title =  mysqli_real_escape_string($this->connect, htmlspecialchars($params['title']) );
			$query = "UPDATE `books` SET `title`='{$title}' WHERE id='{$book_id}'";
			if($res = mysqli_query($this->connect,$query) ){
				return true;
			}else{
			
				print_r ( mysqli_error($this->connect) );
				exit;
				
			}			

			return false;
	
	} 
	// добавление книги
	public function create($params){
			
			if(!isset($params['submit'])) return false;
			
			$title =  mysqli_real_escape_string($this->connect, htmlspecialchars($params['title']) );
			$author_id = (int)$params['author_id'] ;
			$query = "INSERT INTO `books` ( `title`) VALUES ('{$title}')";
			if($res = mysqli_query($this->connect,$query) ){
				$id = mysqli_insert_id($this->connect);
				return $id; // возвращаем вставленный id
			}else{
				
				print_r ( mysqli_error($this->connect) );
				exit;
				
			}
			return false;
	
	} 
	
	
	// получение книг по именам авторов 
	public function findAll(){
	
			$query = "SELECT books.*, authors.firstname, authors.lastname FROM books 
							INNER JOIN books_authors ON books.id=books_authors.book_id 
							INNER JOIN authors ON books_authors.author_id=authors.id 
							ORDER BY books.id";
			
			$arr = [];
			if($res = mysqli_query($this->connect,$query) ){
				$rows_count = mysqli_num_rows($res); // кол-во записей в таблице
				// echo $rows_count;
				while( $row = mysqli_fetch_assoc($res) ){
					
					if(!isset($arr[ $row['id'] ])) {
						$arr[ $row['id'] ] = [
							'id' => $row['id'],
							'title' => $row['title'],	
						];
					}		
					// вывод всех соавторов					
					$arr[ $row['id'] ]['authors'][] = $row['firstname'] . ' ' . $row['lastname']; 					
				}
				
			}

			return $arr;
		
	}	
	
	// получение всех книг 
	public function findAllBooks(){
	
			$query = "SELECT * FROM books ORDER BY books.id";
			$arr = [];
			if($res = mysqli_query($this->connect,$query) ){
				$rows_count = mysqli_num_rows($res); // кол-во записей в таблице
				// echo $rows_count;
				while( $row = mysqli_fetch_assoc($res) ){
					
						$arr[] = [
							'id' => $row['id'],
							'title' => $row['title'],	
						];
							
					// вывод всех соавторов					
				}
				
			}

			return $arr;
		
	}	
	
	// получение книги по имени автора
	public function getBooksByAuthorName($author){
	
			// $title =  mysqli_real_escape_string( htmlspecialchars($_POST['author']) );
			$author = mysqli_real_escape_string( htmlspecialchars($author) );

			$query = "SELECT * FROM `books` WHERE id='{$book_id}'";
			if($res = mysqli_query($this->connect,$query) ){
				$query = "INSERT INTO `books_authors` (`book_id`,`author_id`) VALUES ('{$book_id}','{$author_id}')";
				mysqli_query($this->connect,$query);
				
				return true;
			}
			
			return false;
	
	}
	
	// получение книг по именам авторов 
	public function search($q){
	
			// удаляем все кроме букв и цифр
			$q = preg_replace('/[^a-zA-Zа-яА-Я0-9\s]/','',$q) ;
			
			$q = explode(' ', $q); // разбиваем на слова разделенные пробелом
			if(count($q)==0) return false;		

			$where = ' WHERE ';
			foreach($q as $qitem){
				$where .= " books.title LIKE '%{$qitem}%' OR authors.firstname LIKE '%{$qitem}%' OR authors.lastname LIKE '%{$qitem}%' OR";
			}
			$where = trim($where,'OR'); // удалить крайний
		
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

			return $arr;
		
		
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
	
		 // удаление книги
	public function delete($id){
		
			$table ='books' ; // strtolower( get_class($this) ); // таблица должна быть задана в нижнем регистре, в будущем можно задать имя таблицы в модели table_name
		
			$query = "DELETE FROM `{$table}` WHERE id='{$id}'";
			
			if( mysqli_query($this->connect,$query) ){
				return true;
			}
			
			return false;
	
	} 	
	
	public function test(){
			
			
	}
		
	
}	