<?php
namespace Fincore;

class BackgroundCheck extends \Fincore\Requests {
  public function __construct() {
    parent::__construct();
  }
  
  public function question(int $document): objetct {
    $request = [
      'path' => '/_/outsourcing/questions',
      'queryString' => [
        'document' => $document
      ]
    ];

    return  $this->get($this->buildQuery($request));
  }
  
  public function answers(string $questionTicket, array $answers): objetct {
    $request = [
      'path' => "/_/outsourcing/background-check/answer-me/{$ticket}",
      'data' => $answers
    ];

    return  $this->post($this->buildQuery($request));
  }
  
  public function documentsOCR(string $imageURL, string $type, string $side): objetct {
    $request = [
      'path' => "/_/outsourcing/verify-id",
      'data' => [
        'image' => $imageURL,
        'type' => $type,
        'side' => $side
      ]
    ];

    return  $this->post($this->buildQuery($request));
  }
  
  public function facematch(string $documentURL, string $selfieURL): objetct {
    $request = [
      'path' => "/_/outsourcing/background-check/facematch",
      'data' => [
        'document' => $documentURL,
        'selfie' => $selfieURL
      ]
    ];

    return  $this->post($this->buildQuery($request));
  }
}
