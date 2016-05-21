<?php

namespace Core;

use Core\Di\ContainerInterface;
use Core\Di\ContainerTrait;

class Application implements ContainerInterface
{
    use ContainerTrait;

    public $config = [];

    public function __construct($di)
    {
        $this->setDi($di);
    }

    public function run($uri = '')
    {
        $rules = $this->container->get('router')->addRoute(include_once ROOT.'conf/routes.php')->execute($uri);
        if (class_exists($rules['controller'])) {
            $controller = new $rules['controller']($this->container);
            if (method_exists($controller, $rules['action'])) {
                $action = $rules['action'];
                if(isset($rules['param'])) {
                    $response = $controller->{$action}($rules['param']);
                }else{
                    $response = $controller->{$action}();
                }
                if (is_string($response)) {
                    return $this->container->get('response')->setContent($response)->send();
                } elseif (null === $response) {
                    return $this->container->get('response');
                } else {
                    throw new \Exception('All is bad', 404);
                }
            } else {
                throw new \Exception('Action isn\'t found!', 404);
            }
        } else {
            throw new \Exception('Controller isn\'t found!', 404);
        }
    }


}