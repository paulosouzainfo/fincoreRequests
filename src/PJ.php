<?php
namespace Fincore;

class PJ extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function ads(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/ads',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function basic(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/basic',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function domains(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/domains',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function emails(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/emails',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

   public function mediaExposure(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/media-exposure',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function activityIndicators(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/activity-indicators',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function relationships(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/relationships',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function phones(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/phones',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }
}
