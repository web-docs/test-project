<?php
// класс - модель для работы с книгами
	
Class  Authors extends Model{	
	
	// обновление книги
	public function update($author_id, $params){
			
			// признак того, что пользователь нажал на кнопку сохранить
			if( ! isset($params['submit']) ) return false;
			
			$firstname =  mysqli_real_escape_string($this->connect, htmlspecialchars($params['firstname']) );
			$lastname =  mysqli_real_escape_string($this->connect, htmlspecialchars($params['lastname']) );
			
			$title =  mysqli_real_escape_string($this->connect, htmlspecialchars($params['title']) );
			$query = "UPDATE `authors` SET `firstname`='{$firstname}',`lastname`='{$lastname}' WHERE id='{$author_id}'";
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
			
			if( ! isset($params['submit'])) return false;
			
			$firstname =  mysqli_real_escape_string($this->connect, htmlspecialchars($params['firstname']) );
			$lastname =  mysqli_real_escape_string($this->connect, htmlspecialchars($params['lastname']) );
			
			$query= "INSERT INTO `authors` (`firstname`,`lastname`) VALUES ('{$firstname}','{$lastname}')";
			
			if($res = mysqli_query($this->connect,$query) ){
				$id = mysqli_insert_id($this->connect);
				return $id; // возвращаем вставленный id
			}else{
				
				print_r ( mysqli_error($this->connect) );
				exit;
				
			}
			return false;
	
	}

	
	public function findAll(){		
	
			$table = strtolower( get_class($this) ); // таблица должна быть задана в нижнем регистре, в будущем можно задать имя таблицы в модели table_name
	
			$query = "SELECT * FROM `{$table}`";
			if( $res = mysqli_query($this->connect, $query) ){				
				
				while( $row = mysqli_fetch_assoc($res) ){
					$result[] = $row;
				}
			}else{
				$result = false;
			}			
		
		return $result;
	}	
	
	// добавление автора в книгу
	public function insertAuthorToBook( $book_id, $author_id){
			
			$query = "INSERT INTO `books_authors` (`book_id`,`author_id`) VALUES ('{$book_id}','{$author_id}')";
			
			if($res = mysqli_query($this->connect,$query) ){
				return true;
			}			
			return false;

	
	} 
	// удаление авторов из книги
	public function removeAuthorsFromBook( $book_id ){			
		$query = "DELETE FROM `books_authors` WHERE `book_id`='{$book_id}'";
		if($res = mysqli_query($this->connect,$query) ){
			return true;
		}			
		return false;
	
	}
 	// удаление книг автора
	public function removeBooksFromAuthor( $author_id ){			
		$query = "DELETE FROM `books_authors` WHERE `author_id`='{$author_id}'";
		if($res = mysqli_query($this->connect,$query) ){
			return true;
		}			
		return false;
	
	} 
	
	
	
	// удаление автора из книги
	public function removeAuthorFromBook( $book_id, $autor_id){
			
			$query = "DELETE FROM `books_authors` WHERE `book_id`='{$book_id}' AND `author_id`='{$author_id}'";			
			if($res = mysqli_query($this->connect,$query) ){
				return true;
			}			
			return false;

	
	} 	
	
	
	// получение авторов книги 
	public function getBookAuthors($book_id){
	
			$query = "SELECT author_id as id FROM `books_authors` WHERE `book_id`='{$book_id}'";
			if($res = mysqli_query($this->connect,$query) ){
				$_res =[];
				while( $row = mysqli_fetch_assoc($res) ){
					$_res[] = $row['id'];
				}				
				return $_res;
			}
			
			return false;
	
	}		
	// получение книг авторов 
	public function getAuthorBooks($author_id){
	
			$query = "SELECT book_id as id FROM `books_authors` WHERE `author_id`='{$author_id}'";
			if($res = mysqli_query($this->connect,$query) ){
				$_res =[];
				while( $row = mysqli_fetch_assoc($res) ){
					$_res[] = $row['id'];
				}				
				return $_res;
			}
			
			return false;
	
	}	
	
		 // удаление автора
	public function delete($id){
		
			$table ='authors' ;//strtolower( get_class($this) ); // таблица должна быть задана в нижнем регистре, в будущем можно задать имя таблицы в модели table_name
		
			$query = "DELETE FROM `{$table}` WHERE id='{$id}'";
			
			if( mysqli_query($this->connect,$query) ){
				return true;
			}
			
			return false;
	
	} 	
	


	
	
}	