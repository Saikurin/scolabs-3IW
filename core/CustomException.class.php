<?php

/**
 * Class Exception
 */
class CustomException extends Error
{
    /**
     * @param int $code
     * @param string $message
     * @param string $errorFile
     */
    public function render(int $code, string $message, $errorFile = "")
    {
        parent::__construct($message, $code);

        if (($errorFile !== "") && file_exists("views/errors/" . $errorFile . ".err.php"))
            include "views/errors/" . $errorFile . ".err.php";
        else
            include "views/errors/" . $code . ".err.php";
    }
}