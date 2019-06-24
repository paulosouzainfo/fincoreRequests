<?php

namespace Fincore;

use Buzz\Browser;
use Buzz\Client\Curl;
use Buzz\Client\FileGetContents;
use Buzz\Message\Response;



class Requests   {


    protected $browser;

     public function __construct(Browser $browser = null)
    {
  
     $this->browser = $browser ?: new Browser(function_exists('curl_exec') ? new Curl() : new FileGetContents());
    }  

    public function get($url)
    {
        $response = $this->browser->get($url);
        $this->handleResponse($response);
        return $response->getContent();
    }  

    public function delete($url)
    {
        $response = $this->browser->delete($url);
        $this->handleResponse($response);
    }


     public function put($url, $content = '')
    {
        $headers = [];
        if (is_array($content)) {
            $content = json_encode($content);
            $headers[] = 'Content-Type: application/json';
        }
        $response = $this->browser->put($url, $headers, $content);
        $this->handleResponse($response);
        return $response->getContent();
    }

    public function post($url, $content = '')
    {
        $headers = [];
        if (is_array($content)) {
            $content = json_encode($content);
            $headers[] = 'Content-Type: application/json';
        }
        $response = $this->browser->post($url, $headers, $content);
        $this->handleResponse($response);
        return $response->getContent();
    }

    protected function handleResponse(Response $response)
    {
        if ($response->getStatusCode() === 200) {
            return;
        }
        $this->handleError($response);
    }


    protected function handleError(Response $response)
    {
        $body = $response->getContent();
        $code = $response->getStatusCode();
        $content = json_decode($body);
        throw new HttpException(isset($content->message) ? $content->message : 'Request not processed.', $code);
    }


               


}