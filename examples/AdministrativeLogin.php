<?php
require_once './vendor/autoload.php';

$shiftScript = array_shift($argv);

list($email, $password) = $argv;

$action = new \Fincore\Access();
print_r($action->administrative($email, $password)).PHP_EOL;
