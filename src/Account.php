<?php
namespace Fincore;

class Account extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function UpdatingRegistration($password = null,$nickName = null,$token) {
  $data=[];

  	if(!empty($password)) {
     $data['password']=$password;

  	}
  	if(!empty($nickName)){
  		$data['nickName']=$nickName;
  	}

 
   }


}
