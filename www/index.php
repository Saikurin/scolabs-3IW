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








