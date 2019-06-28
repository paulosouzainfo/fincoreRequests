<?php
namespace Fincore;

class Access extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function administrative(?string $email = null, ?string $password = null): object {
    $request = [
      'path' => '/',
      'data' => [
       'email' => !is_null($email) ? $email : getenv('EMAIL'),
       'password' => !is_null($password) ? $password : getenv('PASSWORD')
      ]
    ];

    return  $this->put($this->buildQuery($request));
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
