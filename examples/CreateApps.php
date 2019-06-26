<?php
require_once './vendor/autoload.php';
$shiftScript = array_shift($argv);
list($url,$dns) = $argv;



$request = new \Fincore\Apps();
$request->println($request->NewApps($url,$dns), true);

