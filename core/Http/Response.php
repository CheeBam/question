<?php

namespace Core\Http;

class Response
{
    protected $headers = array();
    protected $content;
    protected $status = 200;
    protected $version = 'HTTP/1.1';

    public static $statusTexts = array(
        200 => 'OK',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
    );

    public function __construct($content = '', $status = 200)
    {
        $this->setContent($content);
        $this->setStatus($status);
    }

    public function setStatus($status)
    {
        $status = (int)$status;
        if (array_key_exists($status, self::$statusTexts)) {
            $this->status = $status;
            return $this;
        } else {
            throw new \Exception('Illegal status code!');
        }
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    public function getHeaders($key = null)
    {
        return $key?$this->headers[$key]:$this->headers;
    }

    public function redirect($url = null){
        $url = $url?$url:'/';
        header('Location: '.$url, true, 302);
        die;
    }

    public function setHttpVersion($version)
    {
        if ((stristr($version, '1.0') === true) || stristr($version, '1.1') === true) {
            if (stristr($version, 'HTTP/') === true) {
                $this->version = $version;
            } else {
                $this->version = 'HTTP/'.$version;
            }
        } else {
            throw new \Exception('Illegal HTTP version!');
        }
    }

    public function sendHeaders()
    {
        $line = $this->version.' '.$this->status.' '.self::$statusTexts[$this->status];
        header($line, true, $this->status);
        foreach ($this->headers as $key => $value) {
            header($key.':'.$value);
        }
        return $this;
    }

    public function send()
    {
        $this->sendHeaders();
        echo $this->content;
        return $this;
    }
}