<?php

require_once 'vendor/autoload.php';

use Fincore\Users;

$registration = new Users();

$data = [
      'document' => 'your document',
      'email' => 'your email',
      'password' => 'your password',
      'termsOfUse' => '1', //by default always leave 1
      'privacyPolicy' => '1', //by default always leave 1

    ];
//use this structure to make your user registration by default   

$result=$registration->Register($data);
//be the data entered are correct you will receive a response message from api

var_dump($result);
//Success or error response appears in the line above

