<?php
namespace Scolabs\core;

/**
 * Class FileManager
 */
class FileManager
{

    /**
     * @var array
     */
    private $extensions;

    /**
     * @var array
     */
    private $maxFileSize;

    public function __construct(array $params)
    {
        $this->extensions = $params["extensions"];

        foreach ($params["max_file_size"] as $extension => $value) {
            $this->maxFileSize[$extension] = $value;
        }
    }

    /**
     * @param array $file
     * @return bool
     */
    public function isValid(array $file): bool
    {
        if (!in_array($file["type"], $this->extensions)) return false;

        if (isset($this->maxFileSize[$file["type"]])) {
            if ($file['size'] > $this->maxFileSize[$file["type"]]) return false;
        }

        return true;
    }

    /**
     * @param array $file
     * @return string
     */
    public function upload(array $file)
    {
        $uploadDir = DATA_DIR . "/uploads/";
        $fileNameToUpload = date('YmdHis') . '-' . basename($file["name"]);

        if(move_uploaded_file($file['tmp_name'], $uploadDir.$fileNameToUpload)) {
            return $fileNameToUpload;
        } else {
            // TODO: Fix custom exception
            die("Le fichier n'a pu etre envoyé");
        }
    }
}