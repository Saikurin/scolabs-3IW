<?php

class users extends DB
{
    protected $id;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $pwd;
    protected $status;


    public function __construct()
    {
        parent::__construct();
    }

    public function setId($id)
    {
        $this->id=$id;
    }
    public function setFirstname($firstname)
    {
        $this->firstname=ucwords(strtolower(trim($firstname)));
    }
    public function setLastname($lastname)
    {
        $this->lastname=strtoupper(trim($lastname));
    }
    public function setEmail($email)
    {
        $this->email=strtolower(trim($email));
    }
    public function setPwd($pwd)
    {
        $this->pwd=$pwd;
    }
    public function setStatus($status)
    {
        $this->status=$status;
    }



    public static function getRegisterForm(){
        return [
                    "config"=>[
                        "method"=>"POST", 
                        "action"=>helpers::getUrl("user", "register"),
                        "class"=>"user",
                        "id"=>"formRegisterUser",
                        "submit"=>"S'inscrire"
                        ],

                    "fields"=>[
                        "firstname"=>[
                                "type"=>"text",
                                "placeholder"=>"Votre prénom",
                                "class"=>"",
                                "id"=>"",
                                "required"=>true
                            ],
                        "lastname"=>[
                                "type"=>"text",
                                "placeholder"=>"Votre nom",
                                "class"=>"",
                                "id"=>"",
                                "required"=>true],
                        "email"=>[
                                "type"=>"email",
                                "placeholder"=>"Votre email",
                                "class"=>"",
                                "id"=>"",
                                "required"=>true],
                        "pwd"=>[
                                "type"=>"password",
                                "placeholder"=>"Votre mot de passe",
                                "class"=>"",
                                "id"=>"",
                                "required"=>true
                            ],
                        "pwdConfirm"=>[
                                "type"=>"password",
                                "placeholder"=>"Confirmation",
                                "class"=>"",
                                "id"=>"",
                                "required"=>true,
                                "confirmWith"=>"pwd"
                            ],
                        "captcha"=>[
                                "type"=>"captcha",
                                "class"=>"",
                                "id"=>""
                            ]
                    ]
                ];
    }

    public static function getLoginForm(){
        return [

                ];
    }


}












