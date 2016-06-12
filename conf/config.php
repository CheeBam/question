<?php

return array(
    'dbname'            => 'question',
    'host'              => '127.0.0.1',
    'login'             => 'root',
    'password'          => '',
    'dboption'            => array(
                                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                           ),

    'views_path'        => DOC_ROOT.'views/',
    'views_extension'   => '.html.php',

    'mail_agent'        => 'question.notifier@gmail.com',
    'mail_password'     => 'HansZimmer',

    'client_id'         => '736935621398-ngsqs3l54utk19fr88pf6hrc9l64fhdm.apps.googleusercontent.com',
    'client_secret'     => '_tIRUWtKd6k2OLD90eAubZkZ',
    'dev_key'           => 'question-1300',
    'redirect_uri'      => 'http://question.com/login_callback'
);