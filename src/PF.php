<?php
namespace Fincore;

class PF extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
    $this->autoApplicationsLogin();
  }

  public function ads(string $document): object {
    $request = [
      'path' => '/_/outsourcing/persons/ads',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function basic(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/basic',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function memberships(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/memberships',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function publicProfessions(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/public-professions',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

   public function professions(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/professions',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function universityStudents(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/university-students',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function domains(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/domains',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function email(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/emails',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function addresses(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/addresses',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }


  public function mediaExposure(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/media-exposure',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function flagsAndFeatures(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/flags-and-features',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function financial(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/financial',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function kyc(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/kyc',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function interests(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/interests-and-behaviors',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function webPassages(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/web-passages',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function onlinePresence(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/online-presence',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function recurrencyToCharging(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/recurrency-to-charging',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

   public function processes(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/processes',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

   public function socialAssistences(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/social-assistences',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function businessRelationships(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/business-relationships',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function nearbyRelationships(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/nearby-relationships',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function phones(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/phones',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }

  public function vehicles(string $document): object {
  	$request = [
      'path' => '/_/outsourcing/persons/vehicles',
      'queryString' => [
        'document' => $document
      ]
    ];

    return $this->get($this->buildQuery($request));
  }
}
