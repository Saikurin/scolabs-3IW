<?php
class View{

	private $template;
	private $view;


	public function __construct($view, $template="back"){
		$this->setTemplate($template);
		$this->setView($view);
	}



	public function setTemplate($t){
		$this->template = strtolower(trim($t));

		if( !file_exists("views/templates/".$this->template.".tpl.php" )){
			die("Le template n'existe pas");
		}
	}


	public function setView($v){
		$this->view = strtolower(trim($v));

		if( !file_exists("views/".$this->view.".view.php" )){
			die("La vue n'existe pas");
		}
	}



	public function __destruct(){

		include "views/templates/".$this->template.".tpl.php" ;

	}

}






