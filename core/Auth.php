<?php

namespace Scolabs\Core;

class Auth
{

    /**
     * function init
     * @param user
     * @return void
     */

    public static function init($user)
    {
        session_start();
        $_SESSION['user'] = $user;
    }

    /**
     * function destroy
     * @return void
     */

    public static function destroy()
    {
        session_destroy();
    }

    /**
     * function getUser
     * @return user
     */

    public static function getUser()
    {
        return $_SESSION['user'];
    }

    /**
     * function isAuth
     * @return boolean
     */

    public static function isAuth()
    {
        return isset($_SESSION['user']);
    }

    /**
     * function isAdmin
     * @return boolean
     */

    public static function isAdmin()
    {
        return (self::isAuth() && $_SESSION['user']['role'] == 'ADMIN');
    }

    /**
     * function isModerator
     * @return boolean
     */

    public static function isModerator()
    {
        return (self::isAuth() && $_SESSION['user']['role'] == 'MODERATOR');
    }
}
