<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class Mailer
{
    /**
     * @param string $to
     * @param string $fromEmail
     * @param string $fromName
     * @param string $subject
     * @param string $content
     * @param bool $isHTML
     * @param array $attachments
     * @return bool
     * @throws PHPMailerException
     */
    public static function sendMail(string $to, string $fromEmail, string $fromName, string $subject, string $content, bool $isHTML, array $attachments = [])
    {
        if (Validator::checkEmail($fromEmail) && Validator::checkEmail($to)) {
            if (!empty($fromName)) {
                // TODO: Change true to false in production
                $mailer = self::getPHPMailer(true);
                $mailer->CharSet = 'UTF-8';

                $mailer->setFrom($fromEmail, $fromName);
                $mailer->addAddress($to);

                $mailer->isHTML($isHTML);
                $mailer->Subject = $subject;

                $mailer->Body = $content;

                foreach ($attachments as $attachment) {
                    $mailer->addAttachment($attachment);
                }

                $mailer->send();
                return true;
            } else {
                throw WarningException::warningError("Les noms ne respectent pas le format demandé");
            }
        } else {
            throw WarningException::warningError("Les adresses emails renseignés pour l'envoie du mail ne sont pas valide");
        }
    }

    /**
     * @param bool $debug
     * @return PHPMailer|null
     */
    public static function getPHPMailer(bool $debug)
    {
        $mail = new PHPMailer($debug);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = MAILER_URL;
            $mail->SMTPAuth = true;
            $mail->Username = MAILER_USERNAME;
            $mail->Password = MAILER_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = MAILER_PORT;

            return $mail;
        } catch (Exception $e) {
            DangerException::smtpFailure();
        }

        return null;
    }
}