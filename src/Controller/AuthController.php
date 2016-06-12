<?php

namespace Src\Controller;

use Core\Controller;

class AuthController extends Controller
{

    public function __construct($di)
    {
        parent::__construct($di);
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