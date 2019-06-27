<?php
require_once './vendor/autoload.php';

$request = new \Fincore\Administrative();
$request->println($request->DisableApps($argv[1]), true);
