<?php
namespace Scolabs\core;
/**
 * Class DB
 */
class DB
{
    /**
     * @var string
     */
    protected $table;
    /**
     * @var PDO
     */
    protected $pdo;

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
}
