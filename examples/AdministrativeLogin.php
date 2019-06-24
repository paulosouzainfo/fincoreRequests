<?php
require_once './vendor/autoload.php';

$shiftScript = array_shift($argv);

list($email, $password) = $argv;

$action = new \Fincore\Access();
$action->administrative($email, $password);
