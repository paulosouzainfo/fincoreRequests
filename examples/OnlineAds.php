<?php
require_once './vendor/autoload.php';

$request = new \Fincore\PF();
$request->println($request->OnlineAds($argv[1]), true);
