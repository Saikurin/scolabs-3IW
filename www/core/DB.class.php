<?php
class DB{

	private $table;

	public function __construct(){
		//SINGLETON
		try{
			new PDO( DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME , DB_USER , DB_PWD);
		}catch(Exception $e){
			die("Erreur SQL : ".$e->getMessage());
		}

		$this->table =  DB_PREFIXE.get_called_class();

	}


	public function save(){


		// INSERT INTO users (firstname, lastname, email, pwd, status) VALUES (:firstname, :lastname, :email, :pwd, :status);



	}


}