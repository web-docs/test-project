<?php
// базовый класс - контроллера
	
Class  Controller{		

	public $layout = 'main';
	
	// отрисовка шаблона
	public function render($template,$params=null){
						
			if(isset($params)) extract($params); // вытаскиваем переменные из массива для управления ими в шаблоне - view
			// получаем имя модели
			$class =  strtolower( preg_replace('/Controller/','', get_class($this) ) ); 

			if(! file_exists( $_SERVER['DOCUMENT_ROOT'] . '/views/' . $class . '/' . $template . '.php' ) ) return false;
			// подключаем вид из views			
			ob_start();			
				include '/views/' . $class . '/' . $template . '.php'; 
				$content = ob_get_contents(); // здесь содержимое шаблона !
			ob_end_clean();
			
			if(! file_exists( $_SERVER['DOCUMENT_ROOT'] .  '/views/layouts/' . $this->layout . '.php' ) ) return false;
			// подключаем layout
			include '/views/layouts/' . $this->layout . '.php'; 
			
	} 
	
	// возвращаем экз. модели
	public function loadModel($model){
		
		if(! file_exists( $_SERVER['DOCUMENT_ROOT'] . '/models/' . $model . '.php' ) ) return false;			
		include_once '/models/' . $model . '.php'; 		
		return new $model();
	}
	
	// редирект к нужному url
	public function redirect($url){
		header('location: ' . $url);
		exit;
	}
	
	
}	