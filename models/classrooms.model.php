<?php


class classrooms extends QueryBuilder
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
     * @var string
     */
    protected $level;


    public function hydrate(array $datas)
    {
        $this->id = $this->setId($datas['id']);
        $this->name = $this->setName($datas['name']);
        $this->level = $this->setLevel($datas['level']);
        return $this;
    }

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
        if (strlen($name) <= 45) {
            $this->name = $name;
        } else {
            DangerException::fatalError("Le nom ne doit pas dépasser 45 caractères");
        }
    }

    /**
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * @param string $level
     */
    public function setLevel(string $level)
    {
        if (strlen($level) <= 45) {
            $this->level = $level;
        } else {
            DangerException::fatalError("Le niveau ne doit pas dépasser 45 caractères");
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