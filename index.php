<?php

	// поключаем класс для работы с БД
	include_once 'db.php';
					
	$db = New DB();
	$connect = $db->connect(); // коннект к текущей бд, нужно для моделей

	// обработка url
	$url = explode('/', $_SERVER['REQUEST_URI'] );

	//	print_r($url);

	$view = isset($url[1]) ? strtolower($url[1]) :'';
	$object = isset($url[1]) ? ucfirst( strtolower($url[1])) . 'Controller' :'';

	include_once '/controllers/Controller.php' ;  // подключаем баз.класс для контроллера
	include_once '/models/Model.php' ;  // подключаем баз.класс  для модели	

	$controller = $_SERVER['DOCUMENT_ROOT'] .'/controllers/' . $object . '.php';

	$action = 'index';
	// проверяем action
	if(isset($url[2]) ){
		$_action = explode('?',$url[2]); // берем только action без параметров
		$action = strtolower($_action[0]);
	}
	

	// подключаем нужный класс контроллера
	if( $view && file_exists( $controller )  ){ 
			

		loadController($object,$action);		
		
	}else if( $view=='' ){ //  главная страница
			
		loadController('MainController','index');
		
	}else{ // страница ошибки 404 

		loadController('MainController','error404');		

	}

	// загружаем контроллер и выполняем функцию
	function loadController($controller,$action){
		
		// если не задан или передано пустое знач
		if(!isset($action)) $action = 'index';
		
		include_once '/controllers/' . $controller . '.php';
		
		// поключаем класс контроллера		
		$controller = new $controller();

		// проверяем существование вызываемой функции в классе
		if( method_exists($controller, $action )){
				// выполняем вызываемую функцию - action
				$controller->$action(); 			
		}		

	}

