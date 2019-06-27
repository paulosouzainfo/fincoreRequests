<?php
require_once 'vendor/autoload.php';

$request = new \Fincore\AccessHelper();
$request->println($request->forgot($argv[1]), true);
