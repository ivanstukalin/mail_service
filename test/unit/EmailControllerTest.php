<?php
declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Classes\EmailController;

class EmailControllerTest extends TestCase
{
    public function testMailServiceChaine()
    {
        $emailController = new EmailController();
        $emailController->createMessage('Test', '192.168.0.1');
        $emailController->sendMessage();
    }
}