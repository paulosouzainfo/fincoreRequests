<?php
require_once './vendor/autoload.php';

$shiftScript = array_shift($argv);
list($email, $password) = $argv;

$request = new \Fincore\Access();

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $request->println('Você precisa informar um e-mail válido.');
else if(empty($password)) $request->println('Para processamento do seu login é necessário o envio de uma senha.');
else $request->println($request->administrative($email, $password), true);
