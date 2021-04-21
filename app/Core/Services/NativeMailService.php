<?php

namespace App\Core\Services;

use App\Core\Services\Infrastructure\IMailService;
use PHPMailer\PHPMailer\PHPMailer;

class NativeMailService implements IMailService
{
    public function send($from, $to, $subject, $body)
    {
        $headers = 'From: '.$from."\r\n";
        $header = 'MIME-Version: 1.0'."\r\n".'Content-type: text/plain; charset=UTF-8'."\r\n";

        $subject = preg_replace("/(\r\n)|(\r)|(\n)/", "", $subject);
        $subject = preg_replace("/(\t)/", " ", $subject);
        $subject = '=?UTF-8?B?'.base64_encode($subject).'?=';

        @mail($to, $subject, $body, $header.$headers);
    }
}
