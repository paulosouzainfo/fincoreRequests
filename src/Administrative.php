<?php
namespace Fincore;

class Administrative extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function UpdatingApps ($url,$dsn,$IdApp){

    $request = [
      'path' => '/apps/'.$IdApp.'?force=1',
      'data' => [
          'url' => $url,
          'dsn' => $dsn
      ]
    ];
    return  $this->put($this->buildQuery($request));
 
  }

  public function DisableApps($IdApp)
  {
    $request = [
      'path' => '/apps/'.$IdApp
    ];

    return  $this->delete($this->buildQuery($request));
  }


public function ListApps()
  {
    $request = [
      'path' => '/apps'
    ];

    return  $this->get($this->buildQuery($request));
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

  public function ReactivatingApps($url,$dsn)
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

  public function RetrieveApps($IdApp)
  {
    $request = [
      'path' => '/apps/'.$IdApp
    ];

    return  $this->get($this->buildQuery($request));
  }

}
