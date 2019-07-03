<?php
require_once './vendor/autoload.php';
$request = new \Fincore\Access();
$shiftScript = array_shift($argv);
list($email,$senha) = $argv;
$request->println($request->administrative($email,$senha), true);