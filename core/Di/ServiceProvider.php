<?php

namespace Core\Di;

use Core\Application;
use Core\Router;
use Core\Utils\Auth;
use Core\Utils\Mailer;
use Core\Utils\Session;
use Core\View;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $config = include_once ROOT.'conf/config.php';

        $container->set('router', function(){
           return new Router();
        });

        $container->set('request', '\Core\Http\Request');
        $container->set('response', '\Core\Http\Response');

        $container->set('pdo', new \PDO('mysql:dbname=question;host=127.0.0.1', 'root', '', $config['dboption']));

        $container->set('session', new Session());

        $container->set('auth', new Auth(new \Google_Client, $container, $config));

        $container->set('app', function() use ($container){
            return new Application($container);
        });

        $container->set('view', function() use ($config){
            return new View($config);
        });

        $container->set('mailer', function() use ($config){
            return new Mailer($config);
        });

        return $container;
    }
}