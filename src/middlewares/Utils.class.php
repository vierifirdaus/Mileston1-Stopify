<?php 
include_once(PROJECT_ROOT_PATH . "/src/exceptions/UnauthorizedException.class.php");
include_once(PROJECT_ROOT_PATH . "/src/exceptions/ForbiddenException.class.php");

class Utils 
{
    public static function mergeParams(&$params)
    {
        $params = array_merge($params, $_POST, $_GET);
    }

    public static function checkAdmin($params=[])
    {
        self::checkLogin();
        if ($_SESSION['role'] !== "admin")
        {
            throw new ForbiddenException();
        }
    }

    public static function checkUser($params=[])
    {
        self::checkLogin();
        if ($_SESSION['role'] !== "user")
        {
            throw new ForbiddenException();
        }
    }

    public static function checkLogin($params=[])
    {
        if (!isset($_SESSION))
        {
            throw new UnauthorizedException();
        }
    }

}
