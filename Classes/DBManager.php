<?php

namespace Classes;

use Illuminate\Database\Capsule\Manager;
use Classes\EmailStorage;

require_once ROOT_DIR . '/bootstrap.php';
require_once ROOT_DIR . '/config/database.php';

/**
 * Class EmailStorage
 * @author Ivan Stukalin
 */
Class DBManager
{
    /**
    * @var Manager
    */
    private $db;

    /**
    * @var EmailStorage
    */
    private $emailStorage;

    /**
    * @var string
    */
    private $table = 'emails';

    /**
     * Класс для работы с таблицей писем в БД.
     *
     * @param EmailStorage $emailStorage
     */
    public function __construct(EmailStorage $emailStorage) 
    {
        $this->emailStorage = $emailStorage;
    }

    /**
     * Метод сохраняет Email в таблицу писем БД.
     *
     * @return void
     */
    public function saveEmail()
    {   
        try {
            $this->create_connection();

            $id = $this->db::table($this->table)->select('id')
                ->orderBy('desc')
                ->take(1)
                ->get();

            $id = isset($id) ? $id++ : 0;

            $this->db::table($this->table)->insert([
                'id'        => $id,
                'message'   => $this->emailStorage->getMessage(),
                'ip'        => $this->emailStorage->getIp(),
                'date'      => $this->emailStorage->getDate(),
            ]); 
        } catch (\Exception $e) {
            return false;
        }
        
        return true;
    }

    /**
     * Метод проверяет если ли в таблице письма, поступившие сегодня
     * с IP-адреса отправителя API запроса.
     *
     * @return void
     */
    public function findEmail() 
    {
        $message = $this->db::table($this->table)
            ->select('message')
            ->where('ip', '=',$this->emailStorage->getIp())
            ->where('date', '=',$this->emailStorage->getdate())
            ->first();
        
        return $message ? false : true;
    }

    /**
     * Метод создает соединение с БД по указанным в конфиге данным.
     *
     * @return void
     */
    private function create_connection()
    {
        $this->db = new Manager();
        $this->db->addConnection($db_secret); 
    }
}