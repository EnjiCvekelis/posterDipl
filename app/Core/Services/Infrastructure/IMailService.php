<?php

namespace App\Core\Services\Infrastructure {

    interface IMailService
    {
        public function send($from, $to, $subject, $body);
    }
}


