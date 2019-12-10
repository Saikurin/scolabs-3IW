<?php
class View
{
    private $template;
    private $view;
    private $data = [];


    public function __construct($view, $template="back")
    {
        $this->setTemplate($template);
        $this->setView($view);
    }


    public function setTemplate($t)
    {
        $this->template = strtolower(trim($t));

        if (!file_exists("views/templates/".$this->template.".tpl.php")) {
            die("Le template n'existe pas");
        }
    }


    public function setView($v)
    {
        $this->view = strtolower(trim($v));

        if (!file_exists("views/".$this->view.".view.php")) {
            die("La vue n'existe pas");
        }
    }


    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    // $this->addModal("carousel", $data);
    public function addModal($modal, $data)
    {
        if (!file_exists("views/modals/".$modal.".mod.php")) {
            die("Le modal n'existe pas!!!");
        }

        include "views/modals/".$modal.".mod.php";
    }


    public function __destruct()
    {
        // $this->data = ["firstname"=>"yves"];
        extract($this->data);
        //$firstname = "yves";

        include "views/templates/".$this->template.".tpl.php" ;
    }
}
