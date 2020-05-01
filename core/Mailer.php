<?php
namespace Scolabs\core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class Mailer
{

    const HIGH_PRIORITY = 1;
    const NORMAL_PRIORITY = 3;
    const LOW_PRIORITY = 5;

    /**
     * @var PHPMailer|null
     */
    private $mailer;

    /**
     * Mailer constructor.
     */
    public function __construct()
    {
        $this->mailer = new PHPMailer(MAILER_DEBUG);
        try {
            //Server settings
            $this->mailer->SMTPDebug = MAILER_DEBUG ? SMTP::DEBUG_OFF : SMTP::DEBUG_SERVER;
            $this->mailer->CharSet = 'UTF-8';
            $this->mailer->Encoding = 'base64';
            $this->mailer->isSMTP();
            $this->mailer->Host = MAILER_URL;
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = MAILER_USERNAME;
            $this->mailer->Password = MAILER_PASSWORD;
            $this->mailer->SMTPSecure = MAILER_SECURE;
            $this->mailer->Port = MAILER_PORT;
        } catch (Exception $e) {
            DangerException::smtpFailure();
        }
    }

    /**
     * @param string $template
     * @param array $datas
     * @return void
     */
    public function withTemplate(string $template, array $datas)
    {
        if (file_exists("views/templates/mailer/" . $template . ".tpl.php")) {
            extract($datas);
            ob_start();
            include "views/templates/mailer/" . $template . ".tpl.php";
            $content = ob_get_clean();
        } else {
            $content = "";
            WarningException::warningError("Le fichier de template n'existe pas", 404);
        }

        $this->mailer->isHTML(true);

        $this->mailer->Body = $content;
    }

    /**
     * @param array $attachments
     * @throws PHPMailerException
     */
    public function addAttachments(array $attachments)
    {
        foreach ($attachments as $attachment) {
            $this->mailer->addAttachment($attachment);
        }
    }

    /**
     * @param string $fromAndReply
     * @param string $subject
     * @param array $to
     * @param array $cc
     * @param array $cci
     * @param int $priority
     * @return bool
     * @throws PHPMailerException
     */
    public function send(string $fromAndReply, string $subject, array $to, array $cc = [], array $cci = [], int $priority = self::NORMAL_PRIORITY)
    {
        $this->mailer->Priority = $priority;

        $this->mailer->setFrom($fromAndReply);
        $this->mailer->addReplyTo($fromAndReply);

        foreach ($to as $item) {
            $this->mailer->addAddress($item);
        }

        foreach ($cc as $item) {
            $this->mailer->addCC($item);
        }

        foreach ($cci as $item) {
            $this->mailer->addBCC($item);
        }

        $this->mailer->Subject = $subject;

        return $this->mailer->send();
    }
}