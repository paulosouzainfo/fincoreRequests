<?php
namespace Fincore;

class PJ extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function CompaniesAds(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/ads',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesBasic(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/basic',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesDomains(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/domains',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesEmails(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/emails',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

   public function Companiesunemployment_insurance(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/media-exposure',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Companiesactivity_indicators(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/activity-indicators',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesRelationships(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/relationships',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesPhones(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/phones',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }
}
