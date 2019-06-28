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

    return  $this->get($this->buildQuery($request)); 	
  }

  public function BasicCadastral($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/basic?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function ClassAdvice($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/memberships?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PublicPprofessions($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/public-professions?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

   public function PersonsProfessions($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/professions?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function UniversitySstudents($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/university-students?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsDomains($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/domains?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsEmails($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/email?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsAddresses($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/addresses?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }


  public function PersonsMediaExposure($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/media-exposure?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsFlagsAndFeatures($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/flags-and-features?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsFinancial($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/financial?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsKyc($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/kyc?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsDemographic($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/interests?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsWebPassages($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/web-passages?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsOnlinePresence($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/online-presence?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsRecurrencyToCharging($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/recurrency-to-charging?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

   public function PersonsProcesses($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/processes?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

   public function PersonsSocialAssistences($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/social-assistences?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsBusiness($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/business-relationships?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsNearbyRelationships($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/nearby-relationships?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsPhones($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/phones?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsPhones($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/phones?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsVehicles($cpf){

  	$request = [
      'path' => '/_/outsourcing/persons/vehicles?document='.$Cpf
    ];
    return  $this->get($this->buildQuery($request)); 
  }












  







}
