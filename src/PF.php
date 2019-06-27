<?php
namespace Fincore;

class PF extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function OnlineAds($Cpf)
  {
	$request = [
      'path' => '/_/outsourcing/persons/ads?document='.$Cpf
    ];

    return  $this->get($this->buildQuery($request));//07334835778  	
  }

}
