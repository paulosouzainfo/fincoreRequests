<?php
namespace Fincore;

class Access extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function administrative($email, $password)
  {
   if (!empty($password) and !empty($email)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $data =[
           'email' => $email,
           'password' => $password
           ];
          return  $this->put('/',[],[],$data);
         }
       else {
        return 'add a valid email address for your login';
       }            
    }
     else {
      return 'you need to add the email and password field to make the query';
     }
    }
  }

  public function apps($secret, $userID, $token)
  {
    return $this->put(
      '/',
      [
        'secret' => $secret
      ],
      [],
      [
        'userID' => $userID,
        'token' => $token
      ]
    );
  }
}
