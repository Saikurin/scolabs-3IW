<?php

declare(strict_types=1);

/**
 * Class users
 */
class users extends DB
{
    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $dob;

    /**
     * @var string
     */
    protected $mail;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $registerDate;

    /**
     * @return int
     */

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getDob(): string
    {
        return $this->dob;
    }

    /**
     * @param string $dob
     */
    public function setDob(string $dob): void
    {
        $this->dob = $dob;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRegisterDate(): string
    {
        return $this->registerDate;
    }

    /**
     * @param string $register_date
     */
    public function setRegisterDate(string $register_date): void
    {
        $this->registerDate = $register_date;
    }

    public static function getLoginForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => helpers::getUrl("auth", "login"),
                "class" => "user",
                "id" => "formLoginUser",
                "submit" => "Se connecter"
            ],
            "fields" => [
                "mail" => [
                    "type" => "email",
                    "placeholder" => "Votre email",
                    "class" => "form-control",
                    "id" => "",
                    "required" => true,
                    "errorMsg" => "Le format de votre email ne correspond pas",
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe",
                    "class" => "form-control",
                    "id" => "",
                    "required" => true,
                    "errorMsg" => "Mot de passe incorrect"
                ],
            ]
        ];
    }

    /**
     * @return array
     */
    public static function getRegisterForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => helpers::getUrl("auth", "register"),
                "class" => "user",
                "id" => "formRegisterUser",
                "submit" => "S'inscrire"
            ],

            "fields" => [
                "last_name" => [
                    "type" => "text",
                    "placeholder" => "Votre nom de famille",
                    "class" => "form-control",
                    "id" => "",
                    "required" => true,
                    "min-length" => 2,
                    "max-length" => 45,
                    "errorMsg" => "Votre nom de famille doit faire entre 2 et 45 caractères"
                ],
                "first_name" => [
                    "type" => "text",
                    "placeholder" => "Votre prénom",
                    "class" => "form-control",
                    "id" => "",
                    "required" => true,
                    "min-length" => 2,
                    "max-length" => 45,
                    "errorMsg" => "Votre prénom doit faire entre 2 et 45 caractères"
                ],
                "dob" => [
                    "type" => "date",
                    "placeholder" => "",
                    "class" => "form-control",
                    "id" => "",
                    "required" => true,
                    "min-length" => 2,
                    "max-length" => 45,
                    "errorMsg" => "La date de naissance doit être valide"
                ],
                "mail" => [
                    "type" => "email",
                    "placeholder" => "Votre email",
                    "class" => "form-control",
                    "id" => "",
                    "required" => true,
                    "uniq" => [
                        "table" => "users",
                        "column" => "mail",
                    ],
                    "errorMsg" => "Le format de votre email ne correspond pas"
                ],
                "username" => [
                    "type" => "text",
                    "placeholder" => "Votre nom d'utilisateur",
                    "class" => "form-control",
                    "id" => "",
                    "required" => true,
                    "uniq" => [
                        "table" => "users",
                        "column" => "username",
                    ],
                    "errorMsg" => "Le nom d'utilisateur est requis"
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe",
                    "class" => "form-control",
                    "id" => "",
                    "required" => true,
                    "errorMsg" => "Votre mot de passe doit faire entre 6 et 20 caractères avec une minuscule et une majuscule"
                ],
                "pwdConfirm" => [
                    "type" => "password",
                    "placeholder" => "Confirmation",
                    "class" => "form-control",
                    "id" => "",
                    "required" => true,
                    "confirmWith" => "password",
                    "errorMsg" => "Votre mot de passe de confirmation ne correspond pas"
                ],
            ]
        ];
    }
}












