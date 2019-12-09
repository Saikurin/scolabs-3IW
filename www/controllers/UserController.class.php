<?php

class UserController{

	public function defaultAction(){
		echo "User default";
	}

	public function addAction(){
		echo "User add";
	}

	public function removeAction(){
		echo "L'utilisateur va être supprimé";
	}




	public function loginAction(){
		$myView = new View("login", "account");
	}

	public function registerAction(){

		//Insertion d'un user



		$myView = new View("register", "account");
	}

	public function forgotPwdAction(){
		$myView = new View("forgotPwd", "account");
	}

}
