<?php

namespace Classes;

require_once ROOT_DIR . '/bootstrap.php';
/**
 * Class EmailStorage
 * @author Ivan Stukalin
 */
class EmailStorage
{

    /**
     * @var string
     */
    private $message;

    /**
     * @var array
    */
    private $messageInfo = [
        'date'   => '',
        'ip'  => '',
    ];

    /**
     * @param string $title
     * @param string $message
     */
    public function __construct($message) 
    {
        try {
            if (empty($message)) {
                throw new \Exception('Empty message');
            }
            $this->message = $message;

        } catch (\Exception $e) {
            echo 'Ошибка: ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Возращает сообщение
     *
     * @return void
     */
    public function setMessageInfo($date, $ip)
    {
        $this->messageInfo = [
            'date'   => $date,
            'ip'  => $ip,
        ];

        return $this;;
    }

    /**
     * Возращает сообщение
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Возращает дату подачи заявки на отправку
     *
     * @return string
     */
    public function getData()
    {
        return $this->messageInfo['data'];
    }

    /**
     * Возращает ip адрес с которого ушел запрос на отправку
     *
     * @return string
     */
    public function getIp()
    {
        return $this->messageInfo['ip'];
    }

    public function validateMessage()
    {
        $this->message = trim($this->message);
        $this->message = stripslashes($this->message);
        $this->message = htmlspecialchars($this->message);

        return $this->message;
    }
}