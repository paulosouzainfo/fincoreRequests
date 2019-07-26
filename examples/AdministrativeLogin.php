<?php
require_once './vendor/autoload.php';
$request = new \Fincore\Access();
//$shiftScript = array_shift($argv);
//list($email,$senha) = $argv;

$email="kakaroto1500@gmail.com";
$senha="kameran45";
$request->println($request->administrative($email,$senha), true);