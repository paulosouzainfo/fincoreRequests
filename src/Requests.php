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
    $dotenv = Dotenv\Dotenv::create(!is_null($environmentConfig) ? $environmentConfig : __DIR__);
    $dotenv->load();

    if(function_exists('curl_exec')) $selectedMethod = new Curl();
    else $selectedMethod = new FileGetContents();

    if(is_null($browser)) $setBrowser = new Browser($selectedMethod);
    else $setBrowser = $browser;

    $this->browser = $setBrowser;
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

  protected function put($path, $content = '')
  {
    $headers = [];
    if (is_array($content)) {
        $content = json_encode($content);
        $headers[] = 'Content-Type: application/json';
    }
    $response = $this->browser->put(getenv('ENDPOINT').$path, $headers, $content);
    $this->handleResponse($response);
    return $response->getContent();
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
    if($response->getStatusCode() === 200) return;

    $this->handleError($response);
  }

  private function handleError(Response $response)
  {
    $body = $response->getContent();
    $code = $response->getStatusCode();
    $content = json_decode($body);
    throw new HttpException(isset($content->message) ? $content->message : 'Request not processed.', $code);
  }
}
