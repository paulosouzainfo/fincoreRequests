<?php
namespace Fincore;

class AccessHelper extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
    $this->autoAdministrativeLogin();
  }

  public function forgot(string $email): object {
     $request = [
       'path' => '/forgot',
       'data' => [
         'email' => $email
       ],
       'formData' => 'application/x-www-form-urlencoded'
     ];

     return $this->post($this->buildQuery($request));
   }
}
