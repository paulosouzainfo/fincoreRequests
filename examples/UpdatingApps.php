<?php
require_once './vendor/autoload.php';

$shiftScript = array_shift($argv);
list($IdApp) = $argv;

$request = new \Fincore\Administrative();
$request->println($request->RetrieveApps($IdApp), true);

