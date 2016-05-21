<?php

define('CORE', __DIR__.'/../core/');
define('ROOT', __DIR__.'/../');
define('DOC_ROOT', __DIR__.'/');

define('BR', '<Br/>');
define('PRE', '<pre>');

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once(ROOT . '/vendor/autoload.php');

$di = new \Core\Di\Container();
$di->register(new \Core\Di\ServiceProvider());

$di->get('app')->run();

