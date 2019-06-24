<?php

require_once 'vendor/autoload.php';

use Fincore\Users;

$users = new Users();

$data='kakaroto1500@gmail.com';

$result = $users->Passwordrecovery($data);

var_dump($result);
