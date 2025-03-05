<?php

class Func
{

    public static function checkSuperAdmin()
    {
        if (!isset($_COOKIE['role']) || $_COOKIE['role'] !== 'super admin') {
            http_response_code(403);
            exit("Access Denied: You do not have permission to access this page.");
        }
    }

    public static function checkRegularAdmin()
    {
        if (!isset($_COOKIE['role']) || ($_COOKIE['role'] !== 'admin' && $_COOKIE['role'] !== 'super admin')) {
            http_response_code(403);
            exit("Access Denied: You do not have permission to access this page.");
        }
    }

    public static function checkIfLoggedIn()
    {
        if (isset($_COOKIE['username']) && isset($_COOKIE['email']) && isset($_COOKIE['id']) && isset($_COOKIE['role'])) {
            http_response_code(403);
            exit("You are already logged in.");
        }
    }
}
