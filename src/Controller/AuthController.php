<?php

namespace Src\Controller;

use Core\Controller;

class AuthController extends Controller
{
    protected $auth;

    public function __construct($di)
    {
        parent::__construct($di);
        $this->auth = $this->container->get('auth');
    }

    public function callback()
    {
        if($this->auth->checkRedirectCode()) {
            $this->session->set('email', $this->auth->getPayload()['email']);
            $this->response->redirect($this->request->getPrevUri());
        }
    }

    public function logout()
    {
        $this->session->remove('access_token');
        $this->session->remove('email');
        $this->response->redirect($this->request->getPrevUri());
    }
}