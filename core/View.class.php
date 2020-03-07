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
     * @var array -
     */
    private $data = [];

    /**
     * @var array
     */
    private $values = [];

    /**
     * View constructor.
     * @param $view
     * @param string $template
     */
    public function __construct($view, $template = "back")
    {
        $this->setTemplate($template);
        $this->setView($view);
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

        if (!file_exists("views/" . $this->view . ".view.php")) {
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
     * @return void
     */
    public function __destruct()
    {
        extract($this->data);

        include "views/templates/" . $this->template . ".tpl.php";
    }
}
