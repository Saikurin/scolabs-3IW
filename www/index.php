<?php

//http://localhost/user/add -> $c = user et $a add
//http://localhost/user -> $c = user et $a default
//http://localhost -> $c = default et $a default

$uri = $_SERVER["REQUEST_URI"];
// $uri -> /user/add

$uri = trim($uri,"/");

// $uri -> user/add

$uriExploded =  explode("/", $uri);
//http://localhost/user/add -> Array ( [0] => user [1] => add )
//http://localhost -> Array ()

/*
if( empty($uriExploded[0]) ){
	$c = "default";
}else{
	$c = $uriExploded[0];
}
*/

$c = (empty($uriExploded[0]))?"default":$uriExploded[0]; // user, par défault mettre "default"
$a = (empty($uriExploded[1]))?"default":$uriExploded[1]; // add, par défault mettre "default"

$c = $c."Controller";
$a = $a."Action";


//UTILISER LE FICHIER ROUTES.YML



// $c -> UserController = Class
// $a -> addAction = Methode


//Vérifier que dans le dossier controller qu'il y a bien 
//le fichier UserController.class.php
//Sinon faire un die("Le fichier controller n'existe pas");

$pathController = "controllers/".$c.".class.php";

if( file_exists($pathController)){

	include $pathController;
	//Vérifier que la class existe et si ce n'est pas le cas faites un die("La class controller n'existe pas")
	if( class_exists($c) ){

		$controller = new $c();
		
		//Vérifier que la méthode existeet si ce n'est pas le cas faites un die("L'action' n'existe pas")
		if( method_exists($controller, $a) ){
			
			//EXEMPLE :
			//$controller est une instance de la class UserController
			//$a = userAction est une méthode de la class UserController
			$controller->$a();

		}else{
			die("L'action' n'existe pas");
		}


	}else{
		die("La class controller n'existe pas");
	}

}else{
	die("Le fichier controller n'existe pas");
}











