<?php
require_once './vendor/autoload.php';

$shiftScript = array_shift($argv);

list($secret, $userID, $token) = $argv;

$action = new \Fincore\Access();
print_r($action->apps($secret, $userID, $token)).PHP_EOL;
