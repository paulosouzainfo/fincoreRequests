<?php
require_once './vendor/autoload.php';
$request = new \Fincore\Administrative();
$request->println($request->ListApps(), true);

