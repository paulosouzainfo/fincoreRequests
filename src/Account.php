<?php
namespace Fincore;

class Account extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

 public function UpdatingRegistration($password,$nickName ,$token) 
   {
	    $data =[];
	    
		 if(!empty($password)) {
		    $data['password']=$password;
		   
		  }
		 if(!empty($nickName)){
		 	$data['nickName']=$nickName;
		 	
		 }
		 if(!empty($token)) {

		 	$Authorization = [
		 	 	'Authorization'=>$token
		 	];
             
		 	
		 	//3ba2b47f-cb4d-432e-a608-512f7ac37ca0
		 	return  $this->put('/users',[],$Authorization, $data );


		 }
		 
		  

     }

}