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
     * @var array
     */
    private $values = [];

    /**
     * @var array
     */
    private $jsFiles = [];

    /**
     * @var array
     */
    private $cssFiles = [];

    /**
     * @var array
     */
    private $linksCSS = [];

    /**
     * @var array
     */
    private $linksJS = [];

    /**
     * View constructor.
     * @param $view
     * @param string $template
     */
    public function __construct($view, $template = "back")
    {
        $this->setTemplate($template);

        if (strpos($view, ".")) {
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
     * @param array $values
     */
    public function addModal(string $modal, array $data, array $values = [])
    {
        if (!file_exists("views/modals/" . $modal . ".mod.php")) {
            die("Le modal n'existe pas!!!");
        }

        $this->data = $data;
        $this->values = $values;

        include "views/modals/" . $modal . ".mod.php";
    }

    /**
     * @param string $file
     */
    public function addJS(string $file)
    {
        $this->jsFiles[] = $file;
    }

    /**
     * @param string $file
     */
    public function addCSS(string $file)
    {
        $this->cssFiles[] = $file;
    }

    public function addLinkCSS(string $link)
    {
        $this->linksCSS[] = $link;
    }

    public function addLinkJS(string $link)
    {
        $this->linksJS[] = $link;
    }

    public function loadStyles()
    {
        foreach ($this->cssFiles as $cssFile) {
            echo "<link rel='stylesheet' type='text/css' href='public/css/" . $cssFile . "'/>";
        }

        foreach ($this->linksCSS as $link) {
            echo "<link rel='stylesheet' type='text/css' href='" . $link . "'/>";
        }

        if (file_exists("views/" . $this->view . "/" . $this->underfile . "/" . $this->underfile . ".css")) {
            echo "<link rel='stylesheet' type='text/css' href='views/" . $this->view . "/" . $this->underfile . "/" . $this->underfile . ".css'>";
        }

        foreach ($this->jsFiles as $jsFile) {
            echo "<script src='public/js/" . $jsFile . "'></script>";
        }

        foreach ($this->linksJS as $link) {
            echo "<script src='" . $link . "'></script>";
        }

        if (file_exists("views/" . $this->view . "/" . $this->underfile . "/" . $this->underfile . ".js")) {
            echo "<script src='views/" . $this->view . "/" . $this->underfile . "/" . $this->underfile . ".js'></script>";
        }
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
