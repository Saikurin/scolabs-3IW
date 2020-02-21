<?php

class DangerException extends CustomException
{

    public static function unauthorizedException()
    {
        parent::fatalError("Vous n'êtes pas autorisé à consulter cette page");
    }

}