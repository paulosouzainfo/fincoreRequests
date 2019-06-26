<?php
require_once './vendor/autoload.php';
$shiftScript = array_shift($argv);

$request = new \Fincore\Account();
$request->println($request->RecoveringData(), true);
