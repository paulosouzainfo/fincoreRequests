<?php
namespace Fincore;

class PJOnDemand extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function CompaniesIbamaEmbargo($Cnpj)
  {
	$request = [
      'path' => '/_/outsourcing/companies/ibama-embargo?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesIbamaNegativeCertificate($Cnpj)
  {
	$request = [
    'path' => '/_/outsourcing/companies/ibama-negative-certificate?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Companiesnegative_certificate($Cnpj)
  {
	$request = [
    'path' => '/_/outsourcing/companies/ibama-negative-certificate?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesPgfn($Cnpj)
  {
	$request = [
    'path' => '/_/outsourcing/companies/pgfn?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesSiproquim($Cnpj)
  {
	$request = [
    'path' => '/_/outsourcing/companies/siproquim?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesCnpj($Cnpj)
  {
	$request = [
    'path' => '/_/outsourcing/companies/cnpj?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesUnemployment($Cnpj)
  {
	$request = [
    'path' => '/_/outsourcing/companies/qsa?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesFgts($Cnpj)
  {
	$request = [
    'path' => '/_/outsourcing/companies/fgts?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function LegalRepresentative($Cnpj)
  {
	$request = [
    'path' => '/_/outsourcing/companies/legal-representative?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesSimples($Cnpj)
  {
	$request = [
    'path' => '/_/outsourcing/companies/simples?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }
 

}
