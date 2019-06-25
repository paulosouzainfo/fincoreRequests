<?php

require_once 'vendor/autoload.php';

$action = new \Fincore\AccessHelper();

$forgot = new AccessHelper();

$data='kakaroto1500@gmail.com';

$result=$registration->forgot($data);


var_dump($result);
//Success or error response appears in the line above

