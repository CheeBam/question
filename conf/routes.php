<?php

return array(
    'home'           => array(
        'pattern'    => '#^',
        'controller' => 'Src\\Controller\\IndexController',
        'action'     => 'index'
    ),
    'logout'         => array(
        'pattern'    => '#logout',
        'controller' => 'Src\\Controller\\AuthController',
        'action'     => 'logout',
    ),
    'login_callback' => array(
        'pattern'    => '#login_callback',
        'controller' => 'Src\\Controller\\AuthController',
        'action'     => 'callback',
        'params'     => array(
            'get' => '\?[\w\d=\/\-]+'
        )
    ),
    'category'       => array(
        'pattern'    => '#category',
        'controller' => 'Src\\Controller\\IndexController',
        'action'     => 'showCategory',
        'params'     => array(
            'id' => '\/(\d+)'
        )
    ),
    'sbt_question'   => array(
        'pattern'    => '#submitform',
        'controller' => 'Src\\Controller\\QuestionController',
        'action'     => 'questionSubmit'
    ),
    'questions'      => array(
        'pattern'    => '#myquestions',
        'controller' => 'Src\\Controller\\QuestionController',
        'action'     => 'showQuestions',
    ),
    'sbt_radio'      => array(
        'pattern'    => '#submitradio',
        'controller' => 'Src\\Controller\\QuestionController',
        'action'     => 'radioSubmit',
    ),
    'answers'        => array(
        'pattern'    => '#answer',
        'controller' => 'Src\\Controller\\QuestionController',
        'action'     => 'answer',
        'params'     => array(
            'id' => '\/([\w\d]+)'
        )
    ),
    'sbt_answer'     => array(
        'pattern'    => '#submitanswer',
        'controller' => 'Src\\Controller\\QuestionController',
        'action'     => 'answerSubmit'
    ),
    'settings'       => array(
        'pattern'    => '#settings',
        'controller' => 'Src\\Controller\\SettingsController',
        'action'     => 'settings'
    ),
    'change_name'    => array(
        'pattern'    => '#changename',
        'controller' => 'Src\\Controller\\SettingsController',
        'action'     => 'changeName'
    ),
    'become_expert'  => array(
        'pattern'    => '#becomeexpert',
        'controller' => 'Src\\Controller\\SettingsController',
        'action'     => 'becomeExpert'
    ),
    'leave_expert'  => array(
        'pattern'    => '#leaveexpert',
        'controller' => 'Src\\Controller\\SettingsController',
        'action'     => 'leaveExpert'
    )
);