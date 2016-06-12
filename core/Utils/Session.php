<?php

namespace Core\Utils;


class Session
{
    public function __construct()
    {
        session_start();
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function get($name)
    {
        return $_SESSION[$name];
    }

    public function has($name)
    {
        return !empty($_SESSION[$name])?true:false;
    }

    public function remove($name)
    {
        unset($_SESSION[$name]);
    }
}