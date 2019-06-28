<?php
namespace Fincore;

class Emails extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function SearchNetworks(string $email): object {
    $request = [
    'path' => '/_/outsourcing/emails',
    'queryString' => [
    'email' => $email
    ]
    ];

    return  $this->get($this->buildQuery($request));
  }
}
