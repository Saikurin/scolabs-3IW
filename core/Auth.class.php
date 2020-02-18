<?php

class Auth
{

    public static function init($user)
    {
        session_start();
        $_SESSION['user'] = $user;
    }

    public static function destroy()
    {
        session_destroy();
    }

    public static function getUser()
    {
        return $_SESSION['user'];
    }

    public static function isAuth()
    {
        return isset($_SESSION['user']);
    }


    public static function isAdmin()
    {
        return (Auth::isAuth() && $_SESSION['user']['role'] == 'ADMIN');
    }

    public static function isModerator()
    {
        return (Auth::isAuth() && $_SESSION['user']['role'] == 'MODERATOR');
    }
}
