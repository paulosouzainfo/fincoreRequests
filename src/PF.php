<?php
namespace Fincore;

class PF extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function OnlineAds(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/ads',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request)); 	
  }

  public function BasicCadastral(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/basic',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function ClassAdvice(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/memberships',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PublicPprofessions(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/public-professions',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

   public function PersonsProfessions(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/professions',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function UniversitySstudents(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/university-students',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsDomains(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/domains',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsEmails(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/email',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsAddresses(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/addresses',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }


  public function PersonsMediaExposure(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/media-exposure',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsFlagsAndFeatures(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/flags-and-features',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsFinancial(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/financial',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsKyc(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/kyc',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsDemographic(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/interests',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsWebPassages(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/web-passages',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsOnlinePresence(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/online-presence',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsRecurrencyToCharging(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/recurrency-to-charging',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

   public function PersonsProcesses(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/processes',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

   public function PersonsSocialAssistences(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/social-assistences',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsBusiness(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/business-relationships',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsNearbyRelationships(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/nearby-relationships',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsPhones(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/phones',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }

  public function PersonsVehicles(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/vehicles',
      'queryString' => [
        'document' => $document
      ]
    ];
    return  $this->get($this->buildQuery($request)); 
  }












  







}
