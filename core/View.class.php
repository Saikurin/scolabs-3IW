<?php

/**
 * Class View
 */
class View
{
    /**
     * @var string
     */
    private $template;
    /**
     * @var string
     */
    private $view;
    /**
     * @var string
     */
    private $underfile;
    /**
     * @var array -
     */
    private $data = [];


    /**
     * View constructor.
     * @param $view
     * @param string $template
     */
    public function __construct($view, $template = "back")
    {
        $this->setTemplate($template);

        if (strpos($view, ".")){
            $view = explode(".", $view);
            $this->underfile = $view[1];
            $this->view = $view[0];
        } else {
            $this->setView($view);
        }
    }

    /**
     * @param string $template
     * @return void
     */
    public function setTemplate(string $template)
    {
        $this->template = strtolower(trim($template));

        if (!file_exists("views/templates/" . $this->template . ".tpl.php")) {
            die("Le template n'existe pas");
        }
    }


    /**
     * @param string $view
     */
    public function setView(string $view)
    {
        $this->view = strtolower(trim($view));

        if (!file_exists("views/" . $this->view . "/" . $this->view . ".view.php")) {
            die("La vue n'existe pas");
        }
    }

    /**
     * @param string|int $key
     * @param mixed $value
     */
    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }


    /**
     * @param string $modal
     * @param array $data
     */
    public function addModal(string $modal, array $data)
    {
        if (!file_exists("views/modals/" . $modal . ".mod.php")) {
            die("Le modal n'existe pas!!!");
        }

        $this->data = $data;

        include "views/modals/" . $modal . ".mod.php";
    }

    public function loadStyles()
    {
        if (isset($this->underfile)) {
            if (file_exists("views/" . $this->view . "/" . $this->view . "/" . $this->underfile . ".js")) {
                echo "<script src='views/" . $this->view . "/" . $this->view . "/" . $this->underfile . ".js'></script>";
            }
            if (file_exists("views/" . $this->view . "/" . $this->view . "/" . $this->underfile . ".css")) {
                echo "<link rel='stylesheet' type='text/css' href='views/" . $this->view . "/" . $this->view . "/" . $this->underfile . ".css'>";
            }
        } else {
            if (file_exists("views/" . $this->view . "/" . $this->view . ".js")) {
                echo "<script src='views/" . $this->view . "/" . $this->view . ".js'></script>";
            }
            if (file_exists("views/" . $this->view . "/" . $this->view . ".css")) {
                echo "<link rel='stylesheet' type='text/css' href='views/" . $this->view . "/" . $this->view . ".css'>";
            }
        }
        echo $this->underfile;
    }
    /**
     * @return void
     */
    public function __destruct()
    {
        extract($this->data);

        include "views/templates/" . $this->template . ".tpl.php";
    }
}
