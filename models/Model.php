<?php
// класс - модель для работы с книгами
	
Class  Model{	
	
	public $connect = null;
	
	// конструктор
	public function Model(){
		
		global $connect;  // коннект к дб
		
		$this->connect = $connect; // получить коннект к бд
	
	}
			
	public function _findAll(){		
	
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
	
	public function find($id){
		
			$table = strtolower( get_class($this) ); // таблица должна быть задана в нижнем регистре, в будущем можно задать имя таблицы в модели table_name
			
			$query = "SELECT * FROM `{$table}` WHERE id='{$id}'";
			if( $res = mysqli_query($this->connect, $query) ){				
				$res = mysqli_fetch_assoc($res) ;
			}else{
				$res = false;
			}			
		
		return $res;
	}
	
			
	
}	