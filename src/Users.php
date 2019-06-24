<?php
namespace Fincore;
use Fincore\Requests;

class Users extends Requests {

 const Endpoint = 'https://api.fincore.co';
 //const Endpoint = 'https://httpbin.org';
 protected $endpoint;
 protected $browser;

  public function __construct($endpoint = null ,Browser $browser = null) {
    parent::__construct();
    $this->endpoint = $endpoint ?: static::Endpoint;

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