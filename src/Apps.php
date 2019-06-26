<?php
namespace Fincore;

class Apps extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

public function NewApps($url,$dns)
  {
    $request = [
      'path' => '/apps',
         'data' => [
          'url' => $url,
          'dns' => $dns
      ]
    ];

    return  $this->post($this->buildQuery($request));
  }
}
