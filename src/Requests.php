<?php
namespace Fincore;

use \Buzz\Browser;
use \Buzz\Client\Curl;
use \Buzz\Client\FileGetContents;
use \Buzz\Message\Response;

class Requests extends \Fincore\Helpers
{
    private $browser;
    private $queryString        = null;
    private $headers            = [];
    private $temporaryTokenFile = './authTemporaryToken.txt';

    public function __construct(?string $environmentConfig = null, ?Browser $browser = null, string $routesType = 'applications')
    {
      // dotenv só é utilizado em ambiente de desenvolvimento por questões de segurança
      if (null !== getenv('environment') and getenv('environment') !== 'production') {
          $dotenv = \Dotenv\Dotenv::create(!is_null($environmentConfig) ? $environmentConfig : './');
          $dotenv->load();
      }

      $selectedMethod = new FileGetContents();
      $setBrowser = $browser;
      if (function_exists('curl_exec')) {
          $selectedMethod = new Curl();
      }

      $selectedMethod->setTimeout(20);
      if (is_null($setBrowser)) {
          $setBrowser = new Browser($selectedMethod);
      }

      $this->browser = $setBrowser;

      if($routesType === 'administrative') $this->autoAdministrativeLogin();
      else $this->autoApplicationsLogin();

    }

    private function autoAdministrativeLogin(): void {
      $request = [
        'path' => '/',
        'data' => [
         'email' => getenv('EMAIL'),
         'password' => getenv('PASSWORD')
        ]
      ];

      $this->put($this->buildQuery($request));
    }

    private function autoApplicationsLogin(): void {
      $request = [
        'path' => '/',
        'queryString' => [
          'secret' => getenv('SECRET')
        ],
        'data' => [
          'user_id' => getenv('USERID'),
          'token' => getenv('TOKEN')
        ]
      ];

      $this->put($this->buildQuery($request));
    }

    private function setAuth(string $bearer) : void
    {
        if (!is_file($this->temporaryTokenFile)) {
            touch($this->temporaryTokenFile);
        }
        file_put_contents($this->temporaryTokenFile, $bearer);
    }

    private function getAuth() : string
    {
        if (is_file($this->temporaryTokenFile)) {
            if ($authToken = file_get_contents($this->temporaryTokenFile)) {
                return $authToken;
            }

        }

        return '';
    }

    private function setHeaders(array $headers): void
    {
      $this->headers = [];

      foreach ($headers as $key => $value) {
          $this->setHeader($key, is_array($value) ? json_encode($value) : $value);
      }

      if (!empty($this->getAuth())) {
          $this->setHeader('Authorization', $this->getAuth());
      }
    }

    private function setHeader(string $key, $value): void
    {
        array_push($this->headers, $key . ': ' . $value);
    }

    private function setQueryString(array $queryString): void
    {
        if (!empty($queryString)) {
            $this->queryString = '?' . $this->buildQuery($queryString);
        }

    }

    private function setPathToRequest(string $path): string
    {
        if (substr($path, 0, 1) !== '/') {
            $path = '/' . $path;
        }
        return getenv('ENDPOINT') . $path . $this->queryString;
    }

    protected function get(string $path, array $queryString = [], array $headers = []): object
    {
      $parser = $this->parseStr($path);
      if (!empty($parser)) {
        extract($parser);
      }

      $this->setHeaders($headers);
      $this->setQueryString($queryString);

      $request = $this->browser->get($this->setPathToRequest($path), $this->headers);
      return $this->handleResponse($request);
    }

    protected function post(string $path, array $queryString = [], array $headers = [], array $data = [], $formData = 'application/json'): object
    {
        $parser = $this->parseStr($path);
        if (!empty($parser)) {
            extract($parser);
        }
        $this->setHeaders($headers);
        $this->setHeader('Content-Type', $formData);
        $this->setQueryString($queryString);
        if ($formData === 'application/json') {
            $data = json_encode($data);
            $this->setHeader('Content-Length', strlen($data));
        } else {
            $data = http_build_query($data);
        }
        $response = $this->browser->post($this->setPathToRequest($path), $this->headers, $data);

        return $this->handleResponse($response);
    }

    protected function put(string $path,  ?array $queryString = [],  ?array $headers = [],  ?array $data = []) : object
    {
      $parser = $this->parseStr($path);
      if (!empty($parser)) extract($parser);

      $this->setHeaders($headers);
      $this->setQueryString($queryString);

      $data = json_encode($data);

      $this->setHeader('Content-Type', 'application/json');
      $this->setHeader('Content-Length', strlen($data));

      $response = $this->browser->put($this->setPathToRequest($path), $this->headers, $data);

      return $this->handleResponse($response);
    }

    protected function delete(string $path, array $queryString = [], array $headers = []) : object
    {
        $parser = $this->parseStr($path);
        if (!empty($parser)) {
            extract($parser);
        }
        $this->setHeaders($headers);
        $this->setQueryString($queryString);
        $request = $this->browser->delete($this->setPathToRequest($path), $this->headers);
        return $this->handleResponse($request);
    }

    protected function patch(string $path, array $queryString = [], array $headers = []) : object
    {
        $parser = $this->parseStr($path);
        if (!empty($parser)) {
            extract($parser);
        }
        $this->setHeaders($headers);
        $this->setQueryString($queryString);
        $request = $this->browser->patch($this->setPathToRequest($path), $this->headers);
        return $this->handleResponse($request);
    }

    protected function head(string $path, array $queryString = [], array $headers = []): object
    {
        $parser = $this->parseStr($path);
        if (!empty($parser)) {
            extract($parser);
        }

        $this->setHeaders($headers);
        $this->setQueryString($queryString);

        $request = $this->browser->head($this->setPathToRequest($path), $this->headers);
        return $this->handleResponse($request);
    }

    private function handleResponse(Response $response): object
    {
        $responseData = new \stdClass();

        if ($response->getStatusCode() < 400) {
            $bearer = $response->getHeader('authorization');

            if (!is_null($bearer)) {
                $this->setAuth($bearer);
            }
            $responseData->http_status = $response->getStatusCode();
            $responseData->response    = json_decode($response->getContent());
            $attach                    = $response->getHeader('Content-Disposition');
            if (!is_null($attach)) {
                $responseData->response = $this->Filexlsx($attach, $response->getContent());
            }
            return $responseData;
        } else {
            if ($response->getStatusCode() === 401) {
                if (is_file($this->temporaryTokenFile)) {
                    unlink($this->temporaryTokenFile);
                }
            }
        }
        $responseData->http_status = $response->getStatusCode();
        $responseData->response    = json_decode($response->getContent());

        return $responseData;
    }
}
