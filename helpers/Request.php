<?php

class Request
{
    public static function csrf()
    {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            die('Invalid CSRF token');
        }
    }

    public static function old($key)
    {
        return $_SESSION['old_data'][$key] ?? '';
    }

    public static function sanitize($data)
    {
        return htmlspecialchars(trim($data));
    }

    public static function post($key)
    {
        self::csrf();
        return self::sanitize($_POST[$key]);
    }

    public static function get($key)
    {
        return self::sanitize($_GET[$key]);
    }
}
