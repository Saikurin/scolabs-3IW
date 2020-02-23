<?php


class WarningException extends CustomException
{

    public static function whereDidYouGoException()
    {
        parent::warningError("Il parait que tu te sois égaré sur SCOLABS... Ce lien n'existe pas (ou plus) ou tu n'as pas (ou plus) le droit d'y accéder");
    }

}