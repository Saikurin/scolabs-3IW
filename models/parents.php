<?php
namespace Scolabs\models;
use Scolabs\core\QueryBuilder;

class parents extends QueryBuilder
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
     * @var integer
     */
    protected $idUser;

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
     * @return integer
     */
    public function getIdUser(): string
    {
        return $this->idUser;
    }

    /**
     * @param integer $idUser
     */
    public function setIdUser(int $idUser)
    {
        if (is_int($idUser)) {
            $this->idUser = $idUser;
        } else {
            DangerException::fatalError("L'id utilisateur n'est pas correct");
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