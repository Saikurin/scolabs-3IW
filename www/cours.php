
<?php

	// Commentaire sur une ligne
	/*	
		Mon commentaire
	*/

	//Variables
	/*
		Contraintes :
		- Commence par un $
		- Commence pas par un chiffre
		- un nom logique
		- En anglais
		- Camel Case
	*/

	$myFirstname = "Youcef";

	/*
		Type : 
		- Boolean
		- String
		- Integer
		- null
		- Float
	*/


	//Conditions


	$age = 18;
	if($age>18){
		echo "majeur";
	}elseif($age==18){
		echo "tout juste majeur";
	}else{
		echo "mineur";
	}



	//Condition ternaire
	$age = 19;
	if( $age > 18){
		$result = "majeur"; 
	}else{
		$result = "mineur";
	}


	$result = ($age > 18 )?"majeur":"mineur";

	$genre = "Mme";
	switch ($genre) {
		case 'Mr':
			echo "Bonjour Monsieur";
		case 'Mme':
			echo "Bonjour Madame";
		default:
			echo "Salut";
	}


	if($genre == "Mr"){
		echo "Bonjour Monsieur";
		echo "Bonjour Madame";
		echo "Salut";
	}elseif($genre == "Mme"){
		echo "Bonjour Madame";
		echo "Salut";
	}else{
		echo "Salut";
	}


	for($i=0; $i<100; ++$i){

	}


	$i = 0;
	echo $i++; //0
	echo --$i; //0
	echo $i+1; //1
	echo $i+=1; //1
	echo $i;	//1
	echo $i = $i+2; //3
	echo $i; //3

	$cpt = 0;
	while($cpt < 100){

		$cpt = $cpt+rand(0,5);
	}

	do{



	}while();


	//Tableaux

	//$myArray = array();
	$student = ["JALLALI", "Youcef", 12, 13, 8];

	echo $student[1];
	//$student[]= 14;
	//Afficher Youcef a une moyenne de 10.25
	echo $student[1]." a une moyenne de ".(($student[2]+$student[3]+$student[4]*)/4);


	//Dimension
	$classroom = [[],[[[[],[[]]],[[],[[]]]]]];
	echo "<pre>";
	print_r($classroom);


	$classroom = [
					0=>[0=>"JALLALI", 1=>"Youcef", 12, 13, 8],
					1=>["DISPAGNE", "Mel", 5, 4, 1],
					2=>["SIKLI", "Theo", 12.5, 12, 11]
				];

	foreach ($classroom as $key=>$student) {
		
	}



	$student = [
					"Mr",
					"firstname"=>"pierre", 
					"lastname"=>"louise", 
					"age"=>19
				];
	//afficher Nom prénom a age ans
	echo $student["lastname"]." ".$student["firstname"]." a ".$student["age"]. " ans";

	$student[]=19;





