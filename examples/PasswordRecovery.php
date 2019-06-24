<?php

require_once 'vendor/autoload.php';

use Fincore\Users;

$Password_recovery = new Users();

$data='kakaroto1500@gmail.com';

$Password_recovery->Passwordrecovery($data);

var_dump($result);


