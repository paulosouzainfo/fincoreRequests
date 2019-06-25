<?php
namespace Fincore;

use \Buzz\Browser;
use \Buzz\Client\Curl;
use \Buzz\Client\FileGetContents;
use \Buzz\Message\Response;

class Requests extends \Fincore\Helpers {
  protected $browser;
  private $temporaryTokenFile = './authTemporaryToken.txt';

  protected function __construct($environmentConfig = null, Browser $browser = null)
  {
    $dotenv = \Dotenv\Dotenv::create(!is_null($environmentConfig) ? $environmentConfig : './');
    $dotenv->load();

    if(function_exists('curl_exec')) $selectedMethod = new Curl();
    else $selectedMethod = new FileGetContents();

    if(is_null($browser)) $setBrowser = new Browser($selectedMethod);
    else $setBrowser = $browser;

    $this->browser = $setBrowser;
  }

  private function setAuth($bearer): void
  {
    if(!is_file($this->temporaryTokenFile)) {
      touch($this->temporaryTokenFile);
    }
    
    file_put_contents($this->temporaryTokenFile, $bearer);
  }

  private function getAuth(): string
  {
    if(is_file($this->temporaryTokenFile)) {
      if($authToken = file_get_contents($this->temporaryTokenFile)) return $authToken;
    }

    return '';
  }

  protected function get($path)
  {
    $response = $this->browser->get(getenv('ENDPOINT').$path);
    $this->handleResponse($response);
    return $response->getContent();
  }

  protected function post($path, $queryString = null, $headers = [], $data = [], $formData = 'application/json')
  {
    $parser = $this->parseStr($path);
    if(!empty($parser)) extract($parser);

    $query = null;
    if(!is_null($queryString)) $query = '?'.$this->buildQuery($queryString);
  
    if(empty($this->getAuth())) array_push($headers, 'Authorization: '.$this->getAuth());

    if($formData === 'application/json') {
      array_push($headers, 'Content-Type: application/json');
      $data = json_encode($data);
    }
    else {
      array_push($headers, 'Content-Type: '.$formData);
      $data = http_build_query($data);
    }

    $response = $this->browser->post(getenv('ENDPOINT').$path.$query, $headers, $data);

    return $this->handleResponse($response);
  }

  protected function put($path, $queryString = null, $headers = [], $data = [])
  {
    $parser = $this->parseStr($path);
    if(!empty($parser)) extract($parser);

    $query = null;
    if(!is_null($queryString)) $query = '?'.$this->buildQuery($queryString);

    $data = json_encode($data);
   
    if(!empty($this->getAuth())) array_push($headers, 'Authorization: '.$this->getAuth());

    array_push($headers, 'Content-Type: application/json');
    array_push($headers, 'Content-Length: '.strlen($data));

    $response = $this->browser->put(getenv('ENDPOINT').$path.$query, $headers, $data);
    return $this->handleResponse($response);
  }

  protected function delete($path)
  {
    $response = $this->browser->delete(getenv('ENDPOINT').$path);
    $this->handleResponse($response);
  }

  protected function patch()
  {}

  protected function head()
  {}

  private function handleResponse(Response $response)
  {
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
