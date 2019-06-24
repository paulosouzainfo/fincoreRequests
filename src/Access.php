<?php
namespace Fincore;

class Access extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function administrative($email, $password)
  {
    return $this->put(
      '/',
      [],
      [],
      [
        'email' => $email,
        'password' => $password
      ]
    );
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
