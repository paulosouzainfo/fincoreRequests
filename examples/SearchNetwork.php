<?php
require_once './vendor/autoload.php';
$shiftScript = array_shift($argv);
list($email) = $argv;

$request = new \Fincore\Emails();
$request->println($request->SearchNetworks($email), true);
