<?php 

namespace Core\Session;

abstract Class SessionManager
{
    
    public static function set(string $key, mixed $value):void
    {
        $_SESSION[$key]=$value;
    }
    public static function get(string $key):mixed
    {
        if(!isset($_SESSION[$key])) return null;
        return $_SESSION[$key];
    }
    public static function remove(string $key):void
    {
        if(!self::get($key)) return;
        unset($_SESSION[$key]);
    }
}