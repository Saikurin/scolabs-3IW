<?php


use PHPMailer\PHPMailer\PHPMailer;

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
            if (is_int($user->getId())) {
                $_SESSION["auth"]["logged"] = true;
                $_SESSION["auth"]["username"] = $user->getUsername();
                header("Location: " . helpers::getUrl("dashboard", "index"));
            }
        }

        $View = new View("login", "account");
        $View->assign("configFormUser", $configFormUser);
    }

    public function forgetpasswordAction()
    {
        $configForm = users::getForgetPasswordForm();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $mail = $_POST["mail"];
            $user = new users();
            $user->populate(["mail" => $mail]);
            if (is_int($user->getId())) {

                try {

                    $mail = new PHPMailer(true);

                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "pa3iwesgi@gmail.com";
                    $mail->Password = 'PA3IWEsgi2020';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom('noreply@scolabs.fr', 'Scolabs No-Reply');
                    $mail->addAddress($user->getMail(), ucfirst($user->getFirstname()) . " " . strtoupper($user->getLastname()));

                    $mail->isHTML(true);
                    $mail->Subject = 'Scolabs : Mot de passe oublié';
                    $mail->Body = '<p>Bonjour</p></p><p>Afin de réinitialiser votre mot de passe merci de cliquer sur le lien ci-dessous :</p><a href="" style="text-align: center">ICI</a>';

                    $mail->send();
                } catch (\PHPMailer\PHPMailer\Exception $exception) {
                    die($exception->getMessage());
                }

            }
        }

        $View = new View("forgotPwd", "account");
        $View->assign("configForm", $configForm);
    }
}