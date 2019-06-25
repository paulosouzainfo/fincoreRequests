<?php
namespace Fincore;

class AccessHelper extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function forgot($email)
   {
   	 if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
     	return $this->put('/forgot','[]','[]',$email);
     }
   }
}
