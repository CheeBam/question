<?php

namespace Core;

use Core\Di\ContainerInterface;
use Core\di\ContainerTrait;

class Router implements ContainerInterface
{
    use ContainerTrait;

    public $uri;

    protected $routes = [];

    public function addRoute(array $routes)
    {
        $this->routes = array_merge($this->routes, $routes);
        return $this;
    }

    public function execute($uri)
    {

        $this->uri = $uri !== '' ? $uri : $this->container->get('request')->getUri();

        foreach ($this->routes as $name => $route) {

            if(array_key_exists('method', $route)){
                if(strtoupper($route['method']) !== $this->container->get('request')->getMethod()) continue;
            }

            $pattern = $route['pattern'];
            if(array_key_exists('params', $route)){
                foreach($route['params'] as $param => $patt){
                    $pattern .= $patt;
                }
            }
            $pattern .= '$#';

            if(preg_match($pattern, $this->uri, $params)) {
                $controller = array(
                    'controller' => $route['controller'],
                    'action' => $route['action'],
                );
                if (!empty($params[1])) {
                    $controller = array_merge($controller, array('param' => $params[1]));
                }
                return $controller;
            }
        }

        return array(
            'controller' => 'Src\\Controller\\IndexController',
            'action'     => 'notFound'
        );

    }



}