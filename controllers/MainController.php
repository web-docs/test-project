<?php
// класс - контроллер сайта
	
Class  MainController extends Controller{	
	
	
	public function index(){
	
		return $this->render('index');
		
	}
		
	public function error404(){

		return $this->render('error404');
		
	}
				
	
	// парсинг сайта для задачи 6	
	public function parse()	{
		
		$data = json_decode( file_get_contents('http://redlg.ru/projects.json') );
	
		return $this->render('parse', [
			'data'=> $data,
		]); 

		
	}	

	public function getjson(){
		$this->layout = false;
	 	echo file_get_contents('http://redlg.ru/projects.json');
		exit;
	}
	
	
}	