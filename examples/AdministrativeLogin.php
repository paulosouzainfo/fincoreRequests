<?php
require_once './vendor/autoload.php';

$shiftScript = array_shift($argv);
list($email, $password) = $argv;

$println = function($text, $dump = false) {
  if($dump) print_r($dump).PHP_EOL;
  else echo $text.PHP_EOL;
};

$action = new \Fincore\Access();

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $println('Você precisa informar um e-mail válido.');
else if(empty($password)) $println('Para processamento do seu login é necessário o envio de uma senha.');
else $println($action->administrative($email, $password), true);
