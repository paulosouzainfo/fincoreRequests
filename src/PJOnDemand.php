<?php
namespace Fincore;

class PJOnDemand extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function ibamaEmbargo(string $document): object {
    $request = [
        'path' => '/_/outsourcing/companies/ibama-embargo',
        'queryString' => [
          'document' => $document
        ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function ibamaNegativeCertificate(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/ibama-negative-certificate',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function pgfn(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/pgfn',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function siproquim(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/siproquim',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function cnpj(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/cnpj',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function qsa(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/qsa',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function fgts(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/fgts',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function legalRepresentative(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/legal-representative',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function simples(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/simples',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }
}
