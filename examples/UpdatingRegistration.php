<?php
require_once './vendor/autoload.php';
$shiftScript = array_shift($argv);

$request = new \Fincore\Account();
$request->println(
  $request->UpdatingRegistration(
  	 ['password'=>$argv[0],'nickName'=>$argv[1] ]), true);
