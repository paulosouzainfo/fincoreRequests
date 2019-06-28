<?php
namespace Fincore;

class PFOnDemand extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }
  public function Personscriminal_records(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/criminal-records',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Personsibama_embargo(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/ibama-embargo',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Personsnegative_certificate(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/negative-certificate',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

 public function Personspgfn(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/pgfn',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Personsnothing_contained(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/nothing-contained',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Personscpf(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/cpf',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Personshealth_plans(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/health-plans',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

   public function PersonsincomeRefunds(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/income-tax-refunds',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

   public function Personsrais(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/rais',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Personsunemployment_insurance(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/unemployment-insurance',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }
}
