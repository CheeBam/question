<?php

namespace Core\Utils;

use Core\Di\ContainerInterface;
use Core\Di\ContainerTrait;
use Src\Model\Author;

class Auth implements ContainerInterface
{
    use ContainerTrait;

    protected $client;

    protected $config;

    public function __construct(\Google_Client $client = null, $di, $config)
    {
        $this->setDi($di);
        $this->client = $client;
        $this->config = $config;

        if($client){
            //$client->setAccessType('online'); // default: offline
            $client->setApplicationName('Question');
            $client->setClientId($this->config['client_id']);
            $client->setClientSecret($this->config['client_secret']);
            $client->setRedirectUri($this->config['redirect_uri']);
            $client->setDeveloperKey($this->config['dev_key']);
            $client->setScopes('email');
        }
    }

    public function isLoggedIn()
    {
        return $this->container->get('session')->has('access_token');
    }

    public function getAuthUri()
    {
        return $this->client->createAuthUrl();
    }

    public function checkRedirectCode()
    {
        if($this->container->get('request')->has('code')){
            $this->client->authenticate($this->container->get('request')->get('code'));
            $this->setToken($this->client->getAccessToken());
            $this->store($this->getPayload());
            return true;
        }
        return false;
    }

    public function setToken($token)
    {
        $this->container->get('session')->set('access_token', $token['access_token']);
        $this->client->setAccessToken($token);
    }

    public function getPayload()
    {
        return $this->client->verifyIdToken();
    }

    public function store($payload)
    {
        $author = new Author();
        $data = $author->setPDO($this->container->get('pdo'))->find('email', $payload['email']);
        if(!$data){
            $author->google_id = $payload['sub'];
            $author->email = $payload['email'];
            $author->access_token = $this->container->get('session')->get('access_token');
            $author->save();
        }else{
            $data->access_token = $this->container->get('session')->get('access_token');
            $data->setPDO($this->container->get('pdo'));
            $data->update();
        }
    }

    public function verifyLog()
    {
        if($this->container->get('session')->has('access_token')){
            $author = new Author();
            $token = $author->setPDO($this->container->get('pdo'))->findByKey('access_token', 'email', $this->container->get('session')->get('email'));
            if($token['access_token'] === $this->container->get('session')->get('access_token')) return true;
        }
        return false;
    }

}