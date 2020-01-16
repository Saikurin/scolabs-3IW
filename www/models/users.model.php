<?php

declare(strict_types=1);

/**
 * Class users
 */
class users extends DB
{
    /**
     * @var int
     */
    protected $user_id;

    /**
     * @var string
     */
    protected $last_name;

    /**
     * @var string
     */
    protected $first_name;

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
    protected $register_date;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
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
        return $this->register_date;
    }

    /**
     * @param string $register_date
     */
    public function setRegisterDate(string $register_date): void
    {
        $this->register_date = $register_date;
    }


    /**
     * @return array
     */
    public static function getRegisterForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => helpers::getUrl("user", "register"),
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
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email",
                    "class" => "form-control",
                    "id" => "",
                    "required" => true,
                    "uniq" => ["table" => "users", "column" => "email"],
                    "errorMsg" => "Le format de votre email ne correspond pas"
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
                    "class" => "form-control form-control-user",
                    "id" => "",
                    "required" => true,
                    "confirmWith" => "pwd",
                    "errorMsg" => "Votre mot de passe de confirmation ne correspond pas"
                ],
                "captcha" => [
                    "type" => "captcha",
                    "class" => "form-control form-control-user",
                    "id" => "",
                    "required" => true,
                    "placeholder" => "Veuillez saisir les caractères",
                    "errorMsg" => "Captcha incorrect"
                ]
            ]
        ];
    }
}












