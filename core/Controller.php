<?php

namespace Core;

use Core\Di\ContainerInterface;
use Core\Di\ContainerTrait;

class Controller implements ContainerInterface
{
    use ContainerTrait;

    protected $config = [];

    public function __construct($di)
    {
        $this->setDi($di);
        $this->config = include_once ROOT.'conf/config.php';
    }

    public function __get($service)
    {
        return $this->container->get($service);
    }

}