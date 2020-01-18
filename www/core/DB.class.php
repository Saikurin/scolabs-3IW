<?php

class DB
{
    private $id;
    private $table;
    private $pdo;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * DB constructor.
     */
    public function __construct()
    {
        //SINGLETON
        try {
            $this->pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PWD);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }

        $this->table = DB_PREFIXE . get_called_class();
    }



    public function save()
    {
        $propChild = get_object_vars($this);
        $propDB = get_class_vars(get_class());

        $columnsData = array_diff_key($propChild, $propDB);
        $columns = array_keys($columnsData);


        if (!is_numeric($this->id)) {

            //INSERT
            $sql = "INSERT INTO " . $this->table . " (" . implode(",", $columns) . ") VALUE (:" . implode(",:", $columns) . ");";
        } else {

            //UPDATE
            foreach ($columns as $column) {
                $sqlUpdate[] = $column . "=:" . $column;
            }

            $sql = "UPDATE " . $this->table . " SET " . implode(",", $sqlUpdate) . " WHERE id=:id;";
        }


        $queryPrepared = $this->pdo->prepare($sql);
        try {
            $queryPrepared->execute($columnsData);
        }catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * @param array $condition
     */
    public function populate(array $condition = []) : void
    {

        $sql = "SELECT * FROM " . $this->table . " WHERE ";

        $sql .= implode(' AND ', array_map(
            function ($v, $k) {
                return $k . "= :" . $k;
            },
            $condition,
            array_keys($condition)
        ));

        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute($condition);


        $datas = $query->fetch();

        if($query->rowCount() > 0) {
            foreach ($datas as $key => $value) {
                $setter = "set".ucfirst($key);
                $this->{$setter}(trim($value));
            }
        }
    }

    /**
     * @return bool
     */
    public function isPopulate() : bool
    {
        return is_int($this->id);
    }
}
