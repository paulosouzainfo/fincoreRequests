<?php
namespace Fincore;

class Users extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

 function Register($fields){
  	$validate_fields = is_array($fields) ? '1':'';
    	if(!empty($validate_fields)) {
    		$count_fields= count($fields);
    		if($count_fields < 5 || $count_fields > 5) {
    			echo 'There is no need for 5 parameter for registration in Api';
    		}

    	if  (!empty($fields['document']) and  !empty($fields['email']) and
		  !empty($fields['password']) and  !empty($fields['termsOfUse']) and
		  !empty($fields['privacyPolicy'])
		  )
        {
      	$browser = $this->post($this->endpoint.'/register',$fields);
      	return $browser;
        }
        else {
           	echo "Some fields are empty to be able to register";
       }
   	}
  }

  function Passwordrecovery($email){

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'E-mail válido!';
        } else {
        echo 'E-mail inválido!';
        }

   }



	  function ChangePassword (){

	  }



	  function Administrative_Login(){

	 }

}
