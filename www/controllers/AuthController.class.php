<?php


class AuthController
{
    public function registerAction()
    {
        $configForm = users::getRegisterForm();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $errors = Validator::checkForm($configForm, $_POST);
            if (count($errors) === 0) {
                $datas = $_POST;
                $user = new users();
                $user->setFirstName($datas["first_name"]);
                $user->setLastName($datas["last_name"]);
                $user->setDob($datas["dob"]);
                $user->setUsername($datas["username"]);
                $user->setMail($datas["mail"]);
                $user->setPassword($datas["password"]);
                $user->setRegisterDate(date("Y-m-d H:i:s"));
                $user->save();
            }
        }

        $View = new View("register", "account");
        $View->assign("configFormUser", $configForm);
    }

    public function loginAction()
    {
        $configFormUser = users::getLoginForm();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $datas = $_POST;
            $user = new users();
            $user->populate(["mail" => $datas["mail"], "password" => $datas["password"]]);
            if(is_int($user->getId())) {
                $_SESSION["auth"]["logged"] = true;
                $_SESSION["auth"]["username"] = $user->getUsername();
                header("Location: " . helpers::getUrl("dashboard", "index"));
            }
        }

        $View = new View("login", "account");
        $View->assign("configFormUser", $configFormUser);
    }
}