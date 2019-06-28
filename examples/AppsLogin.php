<?php
require_once './vendor/autoload.php';

$action = new \Fincore\Access();
print_r($action->apps()).PHP_EOL;
