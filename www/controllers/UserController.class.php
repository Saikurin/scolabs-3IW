<?php

class UserController{

	//http://localhost/user
	//http://localhost/user/default
	public function defaultAction(){
		echo "User default";
	}

	//http://localhost/user/add
	public function addAction(){
		echo "User add";
	}

}
