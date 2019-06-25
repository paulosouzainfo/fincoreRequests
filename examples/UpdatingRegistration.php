<?php
require_once './vendor/autoload.php';
$shiftScript = array_shift($argv);
list($password,$nickName,$token) = $argv;

$request = new \Fincore\Account();

$request->println($request->UpdatingRegistration($password,$nickName,$token), true);

