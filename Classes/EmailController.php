<?php

namespace Classes;

require_once ROOT_DIR . '/bootstrap.php';

use Classes\EmailStorage;
use Classes\DBManager;
use Classes\MessageSender;
/**
 * Class EmailStorage
 * @author Ivan Stukalin
 */
class EmailController
{
    /**
     * @var EmailStorage
     */
    private $emailStorage;

    /**
     * @var DBManager
     */
    private $dbManager;

    /**
     * Создает класс EmailStorage, приводит сообщение к нормальному виду.
     *
     * @param string $message
     * @param string $ip
     * @return void
     */
    public function createMessage($message, $ip)
    {
        $this->emailStorage = new EmailStorage($message);
        $this->emailStorage->prepareMessage();
        $this->emailStorage->setMessageInfo(date("Y/m/d"), $ip);
    }

    /**
     * Отправляет письмо
     *
     * @return void
     */
    public function sendMessage()
    {
        if($this->saveMessage()) {
            MessageSender::sendMessage($this->emailStorage->getMessage());

            return 'Письмо было успешно отправлено';
        }

        return 'Письмо не было отправлено';
    }

    /**
     * Сохраняет подготовленное письмо в таблицу БД, если с этого IP 
     * ранее, в течении дня, не поступало запросов
     *
     * @return void
     */
    private function saveMessage()
    {
        $this->dbManager = new DBManager($this->emailStorage);
        if(!$this->dbManager->findEmail()) {
            $this->dbManager->saveEmail();
            
            return true;
        } 

        return false;
    }
}