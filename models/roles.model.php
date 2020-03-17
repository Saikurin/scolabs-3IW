<?php


class roles extends QueryBuilder
{
    /**
     * @var null|int
     */
    protected $id = null;

    /**
     * @var string
     */
    protected $name;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        if (strlen($name) <= 20) {
            $this->name = $name;
        } else {
            DangerException::fatalError("Le nom du rôle ne doit pas dépasser 20 caractères");
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
                "action" => helpers::getUrl("Roles", "update", ['id' => $datas['id']]),
                "class" => "",
                "id" => "",
                "submit" => "Modifier le role"
            ],
            "fields" => [
                "name" => [
                    "type" => "text",
                    "required" => true,
                    "placeholder" => "Nom du role",
                    "class" => "",
                    "id" => "",
                    "maxlength" => 20,
                    "errMsg" => "Le nom ne doit pas dépasser 20 caractères",
                ]
            ]
        ];

    }

    public static function getNewEntityForm()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => helpers::getUrl("Roles", "add"),
                "class" => "",
                "id" => "",
                "submit" => "Ajouter un role"
            ],
            "fields" => [
                "name" => [
                    "type" => "text",
                    "required" => true,
                    "placeholder" => "Nom du role",
                    "class" => "",
                    "id" => "",
                    "maxlength" => 45,
                    "errMsg" => "Le nom ne doit pas dépasser 20 caractères"
                ]
            ]
        ];
    }

}