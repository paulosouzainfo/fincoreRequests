<?php
namespace Fincore;

use \Buzz\Browser;
use \Buzz\Client\Curl;
use \Buzz\Client\FileGetContents;
use \Buzz\Message\Response;

class Requests extends \Fincore\Helpers {
  private $browser;
  private $queryString = null;
  private $headers = [];
  private $temporaryTokenFile = './authTemporaryToken.txt';

  protected function __construct(?string $environmentConfig = null, ?Browser $browser = null) {
    if(null !== getenv('environment') and getenv('environment') !== 'production') {
      $dotenv = \Dotenv\Dotenv::create(!is_null($environmentConfig) ? $environmentConfig : './');
      $dotenv->load();
    }

    if(function_exists('curl_exec')) $selectedMethod = new Curl();
    else $selectedMethod = new FileGetContents();

    if(is_null($browser)) $setBrowser = new Browser($selectedMethod);
    else $setBrowser = $browser;

    $this->browser = $setBrowser;
  }

  private function setAuth(string $bearer): void {
    if(!is_file($this->temporaryTokenFile)) {
      touch($this->temporaryTokenFile);
    }
    
    file_put_contents($this->temporaryTokenFile, $bearer);
  }

  private function getAuth(): string {
    if(is_file($this->temporaryTokenFile)) {
      if($authToken = file_get_contents($this->temporaryTokenFile)) return $authToken;
    }

    return '';
  }

  private function setHeaders(array $headers): void {
    $this->headers = $headers;
    
    if(!empty($this->getAuth())) $this->setHeader('Authorization: '.$this->getAuth());
  }
  
  private function setHeader(string $header): void {
    array_push($this->headers, $header);
  }
  
  private function setQueryString(array $queryString): void {
    if(!empty($queryString)) $this->queryString = '?'.$this->buildQuery($queryString);
  }
  
  private function setPathToRequest(string $path): string {
    if(substr($path, 0, 1) !== '/') $path = '/'.$path;
    
    return getenv('ENDPOINT').$path.$this->queryString;
  }
  
  protected function get(string $path, array $queryString = [], array $headers = []): string {
    $parser = $this->parseStr($path);
    if(!empty($parser)) extract($parser);
        
    $this->setHeaders($headers);  
    $this->setQueryString($queryString);

    $request = $this->browser->get($this->setPathToRequest($path), $this->headers);
    return $this->handleResponse($request);
  }

  protected function post(string $path, array $queryString = [], array $headers = [], array $data = [], $formData = 'application/json'): string {
    $parser = $this->parseStr($path);
    if(!empty($parser)) extract($parser);

    $this->setHeaders($headers);  
    $this->setHeader("Content-Type: {$formData}");
    $this->setQueryString($queryString);

    if($formData === 'application/json') {
      $data = json_encode($data);
      $this->setHeader('Content-Length: '.strlen($data));
    }
    else $data = http_build_query($data);

    $response = $this->browser->post($this->setPathToRequest($path), $this->headers, $data);
    return $this->handleResponse($response);
  }

  protected function put(string $path, ?array $queryString = [], ?array $headers = [], ?array $data = []): string {
    $parser = $this->parseStr($path);
    if(!empty($parser)) extract($parser);
    
    $this->setHeaders($headers); 
    $this->setQueryString($queryString);
    
    $data = json_encode($data);
    
    $this->setHeader('Content-Type: application/json');
    $this->setHeader('Content-Length: '.strlen($data));

    $response = $this->browser->put($this->setPathToRequest($path), $this->headers, $data);
    return $this->handleResponse($response);
  }

  protected function delete(string $path, array $queryString = [], array $headers = []): string {
    $parser = $this->parseStr($path);
    if(!empty($parser)) extract($parser);

    $this->setHeaders($headers);  
    $this->setQueryString($queryString);

    $request = $this->browser->delete($this->setPathToRequest($path), $this->headers);
    return $this->handleResponse($request);
  }

  protected function patch(string $path, array $queryString = [], array $headers = []): string {
    $parser = $this->parseStr($path);
    if(!empty($parser)) extract($parser);

    $this->setHeaders($headers);  
    $this->setQueryString($queryString);

    $request = $this->browser->patch($this->setPathToRequest($path), $this->headers);
    return $this->handleResponse($request);
  }

  protected function head(string $path, array $queryString = [], array $headers = []): string {
    $parser = $this->parseStr($path);
    if(!empty($parser)) extract($parser);

    $this->setHeaders($headers);  
    $this->setQueryString($queryString);

    $request = $this->browser->head($this->setPathToRequest($path), $this->headers);
    return $this->handleResponse($request);
  }

  private function handleResponse(Response $response): string {
    if($response->getStatusCode() < 400) {
      $bearer = $response->getHeader('authorization');

      if(!is_null($bearer)) $this->setAuth($bearer);

      return json_encode([
        'http_status' => $response->getStatusCode(),
        'response' => $response->getContent()
      ]);
    }
    else {
      if($response->getStatusCode() === 401) {
        if(is_file($this->temporaryTokenFile)) unlink($this->temporaryTokenFile);
      }
    }

    return json_encode([
      'http_status' => $response->getStatusCode(),
      'response' => $response->getContent()
    ]);
  }
}
