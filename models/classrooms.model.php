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
        if(strlen($name) <= 45) {
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
        if(strlen($level) <= 45) {
            $this->level = $level;
        } else {
            DangerException::fatalError("Le niveau ne doit pas dépasser 45 caractères");
        }
    }


}