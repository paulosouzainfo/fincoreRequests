<?php
namespace Fincore;

class BackgroundCheck extends \Fincore\Requests
{
    public function __construct()
    {
        parent::__construct();
    }

    public function question(int $document): object
    {
        $request = [
            'path'        => '/_/outsourcing/background-check/questions',
            'queryString' => [
                'document' => $document,
            ],
        ];
        return $this->get($this->buildQuery($request));
    }

    public function answers(string $ticket, array $answers): object
    {
        $request = [
            'path' => "/_/outsourcing/background-check/answer-me/{$ticket}",
            'data' => $answers,
        ];
        return $this->post($this->buildQuery($request));
    }

    public function documents(string $imageURL, string $type, string $side):object
    {
      $request = [
          'path' => "/_/outsourcing/background-check/verify-id",
          'data' => [
              'image' => $imageURL,
              'type'  => $type,
              'side'  => $side,
          ],
      ];
      
      return $this->post($this->buildQuery($request));
    }

    public function facematch(string $documentURL, string $selfieURL): object
    {
      $request = [
          'path' => "/_/outsourcing/background-check/facematch",
          'data' => [
              'document' => $documentURL,
              'selfie'   => $selfieURL,
          ],
      ];
      
      return $this->post($this->buildQuery($request));
    }
}
