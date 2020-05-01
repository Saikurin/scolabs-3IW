<?php
namespace Scolabs\core;

/**
 * Class Exception
 */
class CustomException extends Error
{

    const FATAL_ERROR_CODE = 500; // Internal server error
    const WARNING_ERROR_CODE = 303; // See other

    /**
     * @param string $message
     * @param int $code
     */
    public static function fatalError(string $message = "", int $code = self::FATAL_ERROR_CODE)
    {
        if (file_exists("views/templates/exceptions/" . lcfirst(get_called_class()) . ".exc.php")) {

            http_response_code($code);

            // TODO: Maybe extract another value
            extract(["error" => $message]);

            include "views/templates/exceptions/" . lcfirst(get_called_class()) . ".exc.php";
        }
    }

    /**
     * @param string $message
     * @param int $code
     */
    public static function warningError(string $message = "", $code = self::WARNING_ERROR_CODE)
    {
        if (file_exists("views/templates/exceptions/" . lcfirst(get_called_class()) . ".exc.php")) {

            http_response_code($code);

            // TODO: Maybe extract another value
            extract(["error" => $message]);

            include "views/templates/exceptions/" . lcfirst(get_called_class()) . ".exc.php";
        }
    }
}