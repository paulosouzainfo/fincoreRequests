<?php
require_once './vendor/autoload.php';
$shiftScript = array_shift($argv);

$request = new \Fincore\PF();
$request->println($request->OnlineAds($argv[0]), true);
