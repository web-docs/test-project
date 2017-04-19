<?php

	
Class  DB{	
	
	public $connect= null;
	

	public function DB(){
	
		// загрузка массива с настройками бд
		$db_config = include ('db_config.php'); 
	
		// подключение к БД
		try {

			$this->connect = mysqli_connect($db_config['host'], $db_config['username'], $db_config['password'], $db_config['dbname']);

			mysqli_query($this->connect,'SET NAMES utf8');

			
		}catch(Exception $e) {
			echo 'Ошибка при подключении  к БД!';
			exit;
		}
	
	
	}
	
	
	public function connect(){				
		return  $this->connect;
	}
	
	
	
}	