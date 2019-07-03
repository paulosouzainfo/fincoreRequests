<?php
require_once './vendor/autoload.php';

$request = new \Fincore\Access();
$request->println($request->Apps(), true);
