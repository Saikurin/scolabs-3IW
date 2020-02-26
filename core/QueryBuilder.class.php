<?php

class QueryBuilder extends DB
{
    // TO DO -> JOIN
    private $query;
    private $table;
    private $where = "";
    private $order = "";
    private $limit = "";
    private $groupBy = "";
    private $parameters = [];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * function select
     * @param columns array or string
     * @return QueryBuilder
     */

    public function select($columns)
    {
        $this->selector .= "SELECT ";

        if (is_array($columns)) {
            $lastElement = count($columns);
            $i = 1;
            foreach ($columns as $column) {
                $this->selector .= $column;
                if ($i != $lastElement) {
                    $this->selector .= ", ";
                } else {
                    $this->selector .= " ";
                }
                $i++;
            }
        } else {
            $this->selector .= $columns . " ";
        }
        return $this;
    }

    /**
     * function update
     * @param table string
     * @return QueryBuilder
     */

    public function update($table)
    {
        $this->selector .= "UPDATE " . $table . " ";
        return $this;
    }

    /**
     * function findAll
     * @param table string
     * @return QueryBuilder
     */

    public function findAll($table)
    {
        $this->selector = "SELECT *";
        $this->table = $table . " ";

        return $this;
    }

    /**
     * function count
     * @param table string
     * @return QueryBuilder
     */

    public function count($table)
    {
        $this->selector = "SELECT COUNT(*)";
        $this->table = $table . " ";

        return $this;
    }

    /**
     * function where
     * @param column string
     * @param operator string
     * @param value string default null
     * @return QueryBuilder
     */

    public function where($column, $operator, $value = null)
    {
        if (!isset($value)) {
            $value = $operator;
            $operator = "=";
        }
        $this->where .= " " . $column . " " . $operator . " :" . $value . " ";
        return $this;
    }

    /**
     * function like
     * @param column string
     * @param value string default null
     * @return QueryBuilder
     */

    public function like($column, $value = null)
    {
        $this->where .= " " . $column . " LIKE CONCAT('%',:" . $value . ",'%') ";
        return $this;
    }

    /**
     * function orderBy
     * @param column string$
     * @param order stirng
     * @return QueryBuilder
     */

    public function orderBy($column, $order)
    {
        $this->order .= " " . $column . " " . $order . " ";
        return $this;
    }

    /**
     * function groupBy
     * @param group string
     * @return QueryBuilder
     */

    public function groupBy($group)
    {
        $this->groupBy .= " " . $group . " ";
        return $this;
    }

    /**
     * function limit
     * @param limit string
     * @return QueryBuilder
     */

    public function limit($limit)
    {
        $this->limit .= " ".$limit." ";
        return $this;
    }

    /**
     * function get
     * @return array
     */

    public function get()
    {
        if (!isset($this->selector) || !isset($this->table)) {
            return false;
        } else {
            $this->query =
                $this->selector
                . " FROM " . $this->table
                . (!empty($this->where) ? "WHERE" . $this->where : "")
                . (!empty($this->groupBy) ? "GROUP BY" . $this->groupBy : "")
                . (!empty($this->order) ? "ORDER BY" . $this->order : "")
                . (!empty($this->limit) ? "LIMIT" . $this->limit : "");

            $query = $this->pdo->prepare($this->query);
            $query->execute($this->parameters);
            return $query->fetchAll();
        }
    }

    public function getQuery()
    {
        return $this;
    }
}
