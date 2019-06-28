<?php
require_once './vendor/autoload.php';

$request = new \Fincore\Emails();
$request->println($request->SearchNetworks($argv[1]), true);
