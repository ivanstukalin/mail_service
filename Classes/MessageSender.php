<?php

namespace Classes;

require_once ROOT_DIR . '/bootstrap.php';

class MessageSender
{
    /**
     * Отправляет письмо на фиксированный электронный адрес
     *
     * @param string $message
     * @return void
     */
    public static function sendMessage($message)
    {
        mail(FIXED_EMAIL, 'Message from service API', $message);
    }
}