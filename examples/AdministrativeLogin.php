<?php
require_once './vendor/autoload.php';

$email='your email';
$password='your password';
$action = new \Fincore\Access();
$result=$action->administrative($email, $password);
var_dump($result);
