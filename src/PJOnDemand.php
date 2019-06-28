<?php
namespace Fincore;

class PJOnDemand extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function CompaniesIbamaEmbargo(string $document): object {
    $request = [
        'path' => '/_/outsourcing/companies/ibama-embargo',
        'queryString' => [
          'document' => $document
        ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesIbamaNegativeCertificate(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/ibama-negative-certificate',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function Companiesnegative_certificate(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/ibama-negative-certificate',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesPgfn(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/pgfn',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesSiproquim(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/siproquim',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesCnpj(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/cnpj',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesUnemployment(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/qsa',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesFgts(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/fgts',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function LegalRepresentative(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/legal-representative',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function CompaniesSimples(string $document): object {
    $request = [
      'path' => '/_/outsourcing/companies/simples',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }
}
