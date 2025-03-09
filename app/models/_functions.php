<?php

class Func
{
    public $message = "";

    public static function checkSuperAdmin()
    {
        if (!isset($_COOKIE['role']) || $_COOKIE['role'] !== 'super admin') {
            if (self::preventRedirectLoop()) {
                http_response_code(403);
                error_log("403 Forbidden: User role is not super admin.");
                self::show403Page("You don't have permission to access this resource");
            }
        }
    }

    public static function checkRegularAdmin()
    {
        if (!isset($_COOKIE['role']) || !in_array($_COOKIE['role'], ['admin', 'super admin'])) {
            if (self::preventRedirectLoop()) {
                http_response_code(403);
                error_log("403 Forbidden: User role is not admin or super admin.");
                self::show403Page("You don't have permission to access this resource");
            }
        }
    }

    public static function checkIfLoggedIn()
    {
        if (!isset($_COOKIE['username'], $_COOKIE['email'], $_COOKIE['id'], $_COOKIE['role'])) {
            if (self::preventRedirectLoop()) {
                http_response_code(403);
                error_log("403 Forbidden: User is already logged in.");
                self::show403Page("You are already logged in.");
            }
        }
    }

    private static function preventRedirectLoop()
    {
        return $_SERVER['REQUEST_URI'] !== "/public/403";
    }



    private static function show403Page($message)
    {
        require_once __DIR__ . "/../views/Auth/403page.php";
        exit();
    }
}
