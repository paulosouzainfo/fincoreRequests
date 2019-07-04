<?php
namespace Fincore;

class PFOnDemand extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }
  public function criminalRecords(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/criminal-records',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function ibamaEmbargo(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/ibama-embargo',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function negativeCertificate(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/negative-certificate',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

 public function pgfn(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/pgfn',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function nothingContained(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/nothing-contained',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function cpf(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/cpf',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function healthPlans(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/health-plans',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

   public function incomeTaxRefunds(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/income-tax-refunds',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

   public function rais(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/rais',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function unemploymentInsurance(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/unemployment-insurance',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }
}
