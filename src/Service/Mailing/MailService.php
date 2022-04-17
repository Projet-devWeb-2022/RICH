<?php

namespace App\Service\Mailing;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService
{
    protected $object;
    protected $mailto;
    protected $content;

    public function __construct(String $content, String $obj, String $mailto){
        $this->content=$content;
        $this->mailto = $mailto;
        $this->object = $obj;
    }

    public function sendMail(MailerInterface $mailer ){
        $email = (new Email())
            ->from("webrich235@gmail.com")
            ->to($this->mailto)

            ->subject($this->object)
            ->text($this->content);
        $mailer->send($email);
    }
}