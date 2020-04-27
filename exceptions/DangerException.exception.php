<?php

namespace Scolabs\Exception;

class DangerException extends CustomException
{

    public static function unauthorizedException()
    {
        parent::fatalError("Vous n'êtes pas autorisé à consulter cette page");
    }

    public static function smtpFailure()
    {
        parent::fatalError("Le serveur SMTP ne répond pas correctement");
    }

}