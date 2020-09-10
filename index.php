<?php

require_once __DIR__ . '/bootstrap.php';

use Classes\EmailController;

$message = null;
$response = '';
$emailController = new EmailController(); 

if (isset($_POST['message'])) {
    $message = $_POST['message'];
} else {
    $response = 'Получено пустое сообщение';
}
    
$ip = $_SERVER['REMOTE_ADDR'];

if(empty($response)) {
    $emailController->createMessage($message, $ip);
    $respone = $emailController->sendMessage();
}

echo $response;