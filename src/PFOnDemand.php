<?php
namespace Fincore;

class PFOnDemand extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }
  public function Personscriminal_records($Cpf)
  {
	$request = [
      'path' => '/_/outsourcing/persons/criminal-records?document='.$Cpf
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Personsibama_embargo($Cpf)
  {
	$request = [
      'path' => '/_/outsourcing/persons/ibama-embargo?document='.$Cpf
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Personsnegative_certificate($Cpf)
  {
	$request = [
      'path' => '/_/outsourcing/persons/negative-certificate?document='.$Cpf
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

 public function Personspgfn($Cpf)
  {
	$request = [
      'path' => '/_/outsourcing/persons/pgfn?document='.$Cpf
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Personsnothing_contained($Cpf)
  {
	$request = [
      'path' => '/_/outsourcing/persons/nothing-contained?document='.$Cpf
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Personscpf($Cpf)
  {
	$request = [
      'path' => '/_/outsourcing/persons/cpf?document='.$Cpf
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Personshealth_plans($Cpf)
  {
	$request = [
      'path' => '/_/outsourcing/persons/health-plans?document='.$Cpf
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

   public function PersonsincomeRefunds($Cpf)
  {
	$request = [
      'path' => '/_/outsourcing/persons/income-tax-refunds?document='.$Cpf
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

   public function Personsrais($Cpf)
  {
	$request = [
      'path' => '/_/outsourcing/persons/rais?document='.$Cpf
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Personsunemployment_insurance($Cpf)
  {
	$request = [
      'path' => '/_/outsourcing/persons/unemployment-insurance?document='.$Cpf
    ];

    return  $this->get($this->buildQuery($request)); 	
  }



}
