<?php

require_once __DIR__ . '/bootstrap.php';

use Classes\EmailStorage;

$test = new EmailStorage('тест');

$test->setMessageInfo(date("Y/m/d"), '192.168.0.1');





