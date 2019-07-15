<?php
require_once './vendor/autoload.php';

$request = new \Fincore\BackgroundCheck();

$URL_IMAGEM="";
$TIPO="";
$SIDE="";

$request->println($request->documents($URL_IMAGEM,$TIPO,$SIDE), true);



