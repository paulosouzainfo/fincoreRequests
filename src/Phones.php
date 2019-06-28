<?php
namespace Fincore;

class Phones extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function PhonesHistory($phone)
  {
	$request = [
      'path' => '/_/outsourcing/phones/history?phone='.$phone
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function PhoneData($phone)
  {
	$request = [
      'path' => '/_/outsourcing/phones/data?phone='.$phone
    ];

    return  $this->get($this->buildQuery($request)); 	
  }
}
