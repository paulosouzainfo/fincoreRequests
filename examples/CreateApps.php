<?php
require_once './vendor/autoload.php';
$shiftScript = array_shift($argv);
list($url,$dsn) = $argv;

$dsn='mongodb+srv://kakarotodeveloper:IIeni7tQ0nYcFZ45@cluster0-6ke5v.mongodb.net/test?retryWrites=true&w=majority';
$url ='http://localhost';



$request = new \Fincore\Apps();
$request->println($request->NewApps($url,$dsn), true);

