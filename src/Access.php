<?php
namespace Fincore;

class Access extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function administrative($email, $password)
  {
    $request = [
      'path' => '/',
      'data' => [
       'email' => $email,
       'password' => $password
      ]
    ];

    return  $this->put($this->buildQuery($request));
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
