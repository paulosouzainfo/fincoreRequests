<?php
require_once './vendor/autoload.php';

$shiftScript = array_shift($argv);

list($secret, $userID, $token) = $argv;

$action = new \Fincore\Access();
$action->apps($secret, $userID, $token);
