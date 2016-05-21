<?php

namespace Core\Utils;

class Mailer
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function send($to, $subject, $body)
    {
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl');
        $transport->setUsername($this->config['mail_agent']);
        $transport->setPassword($this->config['mail_password']);
        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance('Message')
            ->setFrom('qqaasdd@gmail.com')
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setContentType('text/html');
        $mailer->send($message);
    }
}