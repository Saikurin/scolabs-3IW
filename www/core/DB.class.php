<?php
class DB{

	private $table;
	private $pdo;

	public function __construct(){
		//SINGLETON
		try{
			$this->pdo = new PDO( DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME , DB_USER , DB_PWD);
		}catch(Exception $e){
			die("Erreur SQL : ".$e->getMessage());
		}

		$this->table =  DB_PREFIXE.get_called_class();

	}


	public function save(){

		$propChild = get_object_vars($this);
		$propDB = get_class_vars(get_class());

		$columnsData = array_diff_key($propChild, $propDB);
		$columns = array_keys($columnsData);

		$sql = "INSERT INTO ".$this->table." (".implode(",", $columns).") VALUES (:".implode(",:", $columns).");";

		$queryPrepared = $this->pdo->prepare($sql);
		$queryPrepared->execute($columnsData);

	}


}