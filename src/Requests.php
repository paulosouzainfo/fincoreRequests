<?php
namespace Fincore;

use \Buzz\Browser;
use \Buzz\Client\Curl;
use \Buzz\Client\FileGetContents;
use \Buzz\Message\Response;

class Requests {
  protected $browser;

  protected function __construct($environmentConfig = null, Browser $browser = null)
  {
    if(empty(session_id())) session_start();

    $dotenv = \Dotenv\Dotenv::create(!is_null($environmentConfig) ? $environmentConfig : './');
    $dotenv->load();

    if(function_exists('curl_exec')) $selectedMethod = new Curl();
    else $selectedMethod = new FileGetContents();

    if(is_null($browser)) $setBrowser = new Browser($selectedMethod);
    else $setBrowser = $browser;

    $this->browser = $setBrowser;
  }

  private function setHeaders($headers = [])
  {
    if(!empty($headers)) {
      foreach($headers as $key => $value) {
        $this->headers[strtolower($key)] = $key.": ".$value;
      }
    }
  }

  private function setAuth($bearer)
  {
    $_SESSION['bearer'] = $bearer;
  }

  private function getAuth()
  {
    if(isset($_SESSION['bearer'])) return $_SESSION['bearer'];

    return null;
  }

  protected function get($path)
  {
    $response = $this->browser->get(getenv('ENDPOINT').$path);
    $this->handleResponse($response);
    return $response->getContent();
  }

  protected function post($path, $content = '')
  {
    $headers = [];
    if (is_array($content)) {
      $content = json_encode($content);
      $headers[] = 'Content-Type: application/json';
    }
    $response = $this->browser->post(getenv('ENDPOINT').$path, $headers, $content);
    $this->handleResponse($response);
    return $response->getContent();
  }

  protected function put($path, $query = null, $headers = [], $data = [])
  {
    if(!is_null($query)) '?'.$query = http_build_query($query);
    if(is_array($data)) $data = json_encode($data);

    if($this->getAuth()) array_push($headers, 'Authorization: '.$this->getAuth());

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
    if($response->getStatusCode() === 200) {
      $bearer = $response->getHeader('authorization');

      if(!is_null($bearer)) $this->setAuth($bearer);

      return [
        'http_status' => $response->getStatusCode(),
        'response' => $response->getContent()
      ];
    }

    return [
      'http_status' => $response->getStatusCode(),
      'response' => $response->getContent()
    ];
  }
}
