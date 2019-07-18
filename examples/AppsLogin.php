<?php
require_once './vendor/autoload.php';


$SECRET="e5373786-70ea-44b4-9f36-88bfdf93d376";
$USERID="5d10d9531cc701041aab3134";
$TOKEN="3ba2b47f-cb4d-432e-a608-512f7ac37ca0";

$request = new \Fincore\Access();
$request->println($request->Apps($SECRET,$USERID,$TOKEN), true);
