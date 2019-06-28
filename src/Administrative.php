<?php
namespace Fincore;

class Administrative extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }

  public function RetrieveApp(string $id): string {
    $request = [
      'path' => "/apps/{$id}"
    ];

    return $this->get($this->buildQuery($request));
  }
  
  public function ListApps(): string {
    $request = [
      'path' => '/apps'
    ];

    return  $this->get($this->buildQuery($request));
  }
  
  public function NewApp(string $url, string $dsn): string {
    $request = [
      'path' => '/apps',
      'data' => [
        'url' => $url,
        'dsn' => $dsn
      ]
    ];

    return $this->post($this->buildQuery($request));
  }
  
  public function UpdatingApps(string $url, string $dsn, string $appId): string {
    $request = [
      'path' => "/apps/{$appId}?force=1",
      'data' => [
        'url' => $url,
        'dsn' => $dsn
      ]
    ];
    
    return  $this->put($this->buildQuery($request)); 
  }

  public function DisableApps(string $appId): string {
    $request = [
      'path' => "/apps/{$appId}"
    ];

    return $this->delete($this->buildQuery($request));
  }

  public function ReactivatingApps(string $appId): string {
    $request = [
      'path' => "/apps/{$appId}"
    ];

    return $this->patch($this->buildQuery($request));
  }
}
