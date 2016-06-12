<?php

namespace Core\Http;

class Request
{
    protected $global = array();

    public function __construct()
    {
        if ($this->isPost()) {
            $this->global = is_array($_POST) ? $_POST : array_map('stripslashes', $_POST);
        } else {
            $this->global = is_array($_GET) ? $_GET : array_map('stripslashes', $_GET);
        }
    }

    public function get($key = null)
    {
        if (null !== $key && !array_key_exists($key, $this->global)) {
            return null;
        }
        return $key ? $this->global[$key] : $this->global;
    }

    public function has($key)
    {
        return !empty($this->global[$key]) ? true : false;
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getUri()
    {
        $uri = trim(trim($_SERVER['REQUEST_URI']), '/');
        return $uri;
    }

    public function getPrevUri()
    {
        return substr($_SERVER['HTTP_REFERER'], 19);
    }

    public function isPost()
    {
        return ($_SERVER['REQUEST_METHOD'] == 'POST');
    }

    public function isGet()
    {
        return ($_SERVER['REQUEST_METHOD'] == 'GET');
    }
}