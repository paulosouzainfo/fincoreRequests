<?php
namespace Fincore;

class Account extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

 public function UpdatingRegistration($data) 
   {
   	 $request = [
      'path' => '/users',
      'data' => $data
    ];

	return  $this->put($this->buildQuery($request));
	 }
 }