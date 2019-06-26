<?php
namespace Fincore;

class Emails extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function SearchNetworks($email) 
   {
   	 $request = [
      'path' => '/_/outsourcing/emails',
      'email' => $email
    ];

   return  $this->get($this->buildQuery($request));
	 }
}
