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
     * Класс для хранения работы с информацией о
     * электронном письме.
     * 
     * @param string $message.
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
     * Устанавливает дату поступления запроса и ip-
     * -адресс с которого поступл запрос.
     *
     * @return void
     */
    public function setMessageInfo($date, $ip)
    {
        $this->messageInfo = [
            'date'   => $date,
            'ip'  => $ip,
        ];
    }

    /**
     * Возращает сообщение.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Возращает дату подачи заявки на отправку.
     *
     * @return string
     */
    public function getDate()
    {
        return $this->messageInfo['date'];
    }

    /**
     * Возращает ip адрес с которого ушел запрос на отправку.
     *
     * @return string
     */
    public function getIp()
    {
        return $this->messageInfo['ip'];
    }

    /**
     * Убирает из сообщения все лишнее, защищает от подставленного в форму
     * текста с недобросовестным содержанием (скриптов и прочего). 
     *
     * @return void
     */
    public function prepareMessage()
    {
        $this->message = trim($this->message);
        $this->message = stripslashes($this->message);
        $this->message = htmlspecialchars($this->message);
    }
}