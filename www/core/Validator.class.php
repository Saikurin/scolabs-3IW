<?php

declare(strict_types=1);

class Validator
{

    public static function checkForm(array $configForm, array $data): array
    {
        $listOfErrors = [];

        //Vérifier le nb de input
        if (count($configForm["fields"]) == count($data)) {

            foreach ($configForm["fields"] as $name => $config) {

                if (!array_key_exists($name, $data) ||
                    ($config["required"] && empty($data[$name]))
                ) {
                    return ["Tentative de hack !!!"];
                }

                if(isset($config["uniq"])) {
                    $table = $config["uniq"]["table"];
                    $field = $config["uniq"]["column"];

                    $table = new $table();
                    $table->populate([$field => $data[$name]]);
                    if($table->isPopulate()) {
                        $listOfErrors[] = $config["errorMsg"];
                    }
                }

                switch ($config["type"]) {
                    case "email":
                        if (!self::checkEmail($data[$name])) {
                            $listOfErrors[] = $config["errorMsg"];
                        }
                        break;
                    case "captcha":
                        if ($_SESSION["captcha"] !== $data[$name]) {
                            $listOfErrors[] = $config["errorMsg"];
                        }
                        break;
                    case "password":
                        if (!self::checkPwd($data[$name])) {
                            $listOfErrors[] = $config["errorMsg"];
                        }
                        break;
                }

                if (isset($config["confirmWith"])) {
                    $fieldConfirm = $config["confirmWith"];
                    $valueConfirm = $data[$fieldConfirm];
                    if ($data[$name] !== $valueConfirm)
                        $listOfErrors[] = $config["errorMsg"];
                }

            }

        } else {
            return ["Tentative de hack !!!"];
        }

        return $listOfErrors;
    }

    /**
     * @param string $email
     * @return bool
     */
    public static function checkEmail(string $email): bool
    {
        $email = trim($email);
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    /**
     * @param string $pwd
     * @return bool
     */
    public static function checkPwd(string $pwd): bool
    {
        return (preg_match('/^(?=.*[0-9])(?=.*[A-Z]).{6,20}$/', $pwd)) ? true : false;
    }
}