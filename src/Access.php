<?php
namespace Fincore;

class Access extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function verifica($number,$number2){
    return $number + $number2;
  }

  public function administrative(string $email = null, string $password = null) {

    $email     = strlen($email) > 6 ? $email : getenv('EMAIL');
    $password  = strlen($password) > 6 ? $password :getenv('PASSWORD');

    $request = [
      'path' => '/',
      'data' => [
       'email' => $email,
       'password' => $password
      ]
    ];
    return $request;
    //return $request['data']['email'];
   // return $request['data']['password'];
    //return  $this->put($this->buildQuery($request));
  }

  public function apps(?string $secret = null, ?string $userID = null, ?string $token = null): object {
    return $this->put(
      '/',
      [
        'secret' => !is_null($secret) ? $secret : getenv('SECRET')
      ],
      [],
      [
        'user_id' => !is_null($userID) ? $userID : getenv('USERID'),
        'token' => !is_null($token) ? $token : getenv('TOKEN')
      ]
    );
  }
}
