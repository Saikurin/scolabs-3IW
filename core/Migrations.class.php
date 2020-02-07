<?php

class Migrations
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PWD);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    /**
     * @param string $sql
     * @return void
     */
    public function executeSQL(string $sql)
    {
        $this->pdo->query($sql);
    }


    /**
     * @return PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }
}