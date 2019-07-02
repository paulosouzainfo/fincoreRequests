<?php
namespace Fincore;

class Access extends \Fincore\Requests {  
  public function __construct() {
    parent::__construct();
  }

  public function administrative(string $email, string $password): object {
    try {
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new \Exception('O e-mail não é válido.');
      if(!strlen($password) < 6) throw new \Exception('A senha não pode conter menos de 6 caracteres.');
      
      $request = [
        'path' => '/',
        'data' => [
         'email' => $email,
         'password' => $password
        ]
      ];
      
      return $this->put($this->buildQuery($request));
    }
    catch(\Exception $e) {
      $e->http_status = 500;
      return $e;
    }
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
