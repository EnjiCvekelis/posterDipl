<?php

namespace App\Core\Services;

use App\Core\Services\Infrastructure\IMailService;
use PHPMailer\PHPMailer\PHPMailer;

class MailService implements IMailService
{
    public function send($from, $to, $subject, $body)
    {
        $mail = new PHPMailer(true);

        //Server settings
        $mail->isMail();
        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom($from);
        $mail->AddAddress($to);

        //Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
    }
}
