<?php


class students extends QueryBuilder
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @var int
     */
    protected $parent1;

    /**
     * @var int
     */
    protected $parent2;


    /**
     * @return int|null
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname)
    {
        if (strlen($lastname) <= 45) {
            $this->lastname = $lastname;
        } else {
            DangerException::fatalError("Le nom ne doit pas dépasser 45 caractères");
        }
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
    public function setFirstName(string $firstname)
    {
        if (strlen($firstname) <= 45) {
            $this->firstname = $firstname;
        } else {
            DangerException::fatalError("Le prénom ne doit pas dépasser 45 caractères");
        }
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        if (strlen($email) <= 255) {
            $this->email = $email;
        } else {
            DangerException::fatalError("L'adresse mail ne doit pas excéder 254 caractères");
        }
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        if (strlen($address) <= 255) {
            $this->address = $address; // TODO : Do a better check for address & all
        } else {
            DangerException::fatalError("L'adresse ne doit pas excéder 255 caractères");
        }
    }

    /**
     * @return string
     */
    public function getParent1(): string
    {
        return $this->parent1;
    }

    /**
     * @param string $parent1
     */
    public function setParent1(string $parent1)
    {
        if ($parent1) { // Retournes un entier
            $this->address = $parent1; // TODO : Do a better check for parents & create a better system (implémenter le système de rôles)
        } else {
            DangerException::fatalError("L'id du parent n'est pas correct");
        }
    }
    /**
     * @param array $datas
     * @return array
     */
    public static function getEditEntityForm(array $datas)
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => helpers::getUrl("Classrooms", "update", ['id' => $datas['id']]),
                "class" => "",
                "id" => "",
                "submit" => "Modifier la classe"
            ],
            "fields" => [
                "name" => [
                    "type" => "text",
                    "required" => true,
                    "placeholder" => "Nom de la classe",
                    "class" => "",
                    "id" => "",
                    "maxlength" => 45,
                    "errMsg" => "Le nom ne doit pas dépasser 45 caractères",
                ],
                "level" => [
                    "type" => "text",
                    "required" => true,
                    "placeholder" => "Niveau de la classe (3ème, 4ème ...)",
                    "class" => "",
                    "id" => "",
                    "maxlength" => 45,
                    "errMsg" => "Le nom ne doit pas dépasser 45 caractères"
                ]
            ]
        ];

    }

    public static function getNewEntityForm()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => helpers::getUrl("Classrooms", "add"),
                "class" => "",
                "id" => "",
                "submit" => "Ajouter une classe"
            ],
            "fields" => [
                "name" => [
                    "type" => "text",
                    "required" => true,
                    "placeholder" => "Nom de la classe",
                    "class" => "",
                    "id" => "",
                    "maxlength" => 45,
                    "errMsg" => "Le nom ne doit pas dépasser 45 caractères"
                ],
                "level" => [
                    "type" => "text",
                    "required" => true,
                    "placeholder" => "Niveau de la classe (3ème, 4ème ...)",
                    "class" => "",
                    "id" => "",
                    "maxlength" => 45,
                    "errMsg" => "Le nom ne doit pas dépasser 45 caractères"
                ]
            ]
        ];
    }

}