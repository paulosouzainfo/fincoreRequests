<?php
require_once './vendor/autoload.php';
$shiftScript = array_shift($argv);
list($url,$dsn) = $argv;

$request = new \Fincore\Administrative();
$request->println($request->NewApps($url,$dsn), true);

