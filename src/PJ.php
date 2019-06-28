<?php
namespace Fincore;

class PJ extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function CompaniesAds($Cnpj)
  {
	$request = [
      'path' => '/_/outsourcing/companies/ads?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesBasic($Cnpj)
  {
	$request = [
      'path' => '/_/outsourcing/companies/basic?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesDomains($Cnpj)
  {
	$request = [
      'path' => '/_/outsourcing/companies/domains?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesEmails($Cnpj)
  {
	$request = [
      'path' => '/_/outsourcing/companies/emails?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

   public function Companiesunemployment_insurance($Cnpj)
  {
	$request = [
      'path' => '/_/outsourcing/companies/media-exposure?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Companiesactivity_indicators($Cnpj)
  {
	$request = [
      'path' => '/_/outsourcing/companies/activity-indicators?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesRelationships($Cnpj)
  {
	$request = [
      'path' => '/_/outsourcing/companies/relationships?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesPhones($Cnpj)
  {
	$request = [
      'path' => '/_/outsourcing/companies/phones?document='.$Cnpj
    ];

    return  $this->get($this->buildQuery($request)); 	
  }




}
