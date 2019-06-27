<?php
namespace Fincore;

class Administrative extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function NewApps($url,$dsn)
  {
    $request = [
      'path' => '/apps',
         'data' => [
          'url' => $url,
          'dsn' => $dsn
      ]
    ];

    return  $this->post($this->buildQuery($request));
  }
  
}
