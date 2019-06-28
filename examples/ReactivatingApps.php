<?php
require_once './vendor/autoload.php';

$shiftScript = array_shift($argv);

$request = new \Fincore\Administrative();
$request->println($request->ReactivatingApps($argv[0]), true);

