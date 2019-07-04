<?php
require_once './vendor/autoload.php';


$SECRET="45bb2e45-ed74-4ef0-a4d9-cce53203f211";
$USERID="5d10d9531cc701041aab3134";
$TOKEN="3ba2b47f-cb4d-432e-a608-512f7ac37ca0";

$request = new \Fincore\Access();
$request->println($request->Apps($SECRET,$USERID,$TOKEN), true);
