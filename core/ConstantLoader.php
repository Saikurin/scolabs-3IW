<?php

namespace Scolabs\Core;

/**
 * Class ConstantLoader
 */
class ConstantLoader
{
    /**
     * @var string
     */
    public $extend;
    /**
     * @var string
     */
    public $text;

    /**
     * ConstantLoader constructor.
     * @param string $extend
     */
    public function __construct($extend = "dev")
    {
        $this->extend = $extend;
        $this->checkFilesEnv();
        $this->getContentFiles();
        $this->load();
    }

    /**
     * @return void
     */
    public function checkFilesEnv()
    {
        if (!file_exists(".env")) {
            die("Le fichier .env n'existe pas");
        }
        if (!file_exists("." . $this->extend)) {
            die("Le fichier ." . $this->extend . " n'existe pas");
        }
    }

    /**
     * @return void
     */
    public function getContentFiles()
    {
        $this->text = file_get_contents("." . $this->extend);
        $this->text .= "\n" . file_get_contents(".env");
    }

    /**
     * @return void
     */
    public function load()
    {
        $lines = explode("\n", $this->text);
        foreach ($lines as $line) {
            $data = explode("=", $line);
            if (!defined($data[0]) && isset($data[1])) {
                define($data[0], trim($data[1]));
            }
        }
    }
}
