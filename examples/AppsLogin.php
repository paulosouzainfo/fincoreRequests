<?php
require_once './vendor/autoload.php';


$SECRET="a64cb62c-5119-4dc7-ad81-fd182392db72";
$USERID="5d10d9531cc701041aab3134";
$TOKEN="3ba2b47f-cb4d-432e-a608-512f7ac37ca0";

$request = new \Fincore\Access();
$request->println($request->Apps($SECRET,$USERID,$TOKEN), true);
