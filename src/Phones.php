<?php
namespace Fincore;

class Phones extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
    $this->autoApplicationsLogin();
  }

  public function PhonesHistory(string $phone): object
  {
    $request = [
      'path' => '/_/outsourcing/phones/history?phone='.$phone
    ];

    return  $this->get($this->buildQuery($request));
  }

  public function PhoneData(string $phone): object
  {
    $request = [
        'path' => '/_/outsourcing/phones/data?phone='.$phone
    ];

    return  $this->get($this->buildQuery($request));
  }
}
