<?php
namespace Fincore;

class Access extends \Fincore\Requests {  
  public function __construct() {
    parent::__construct();
  }

  public function Administrative(string $email, string $password): object {
    $request = [
      'path' => '/',
      'data' => [
       'email' => $email,
       'password' => $password
      ]
    ];
    
    return $this->put($this->buildQuery($request));
  }

  public function Apps(string $secret, string $userID, string $token): object {

    return $this->put(
      '/',
      [
        'secret' => $secret
      ],
      [],
      [
        'user_id' =>$userID,
        'token' =>$token
      ]
    );
  }
}
