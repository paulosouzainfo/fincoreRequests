<?php
namespace Fincore;

class Apps extends \Fincore\Requests
{
    public function __construct()
    {
        parent::__construct();
        $this->autoApplicationsLogin();
    }

    public function DocumentsCreate(string $collection, array $data): object
    {
      $request = [
          'path' => "/_/{$collection}",
          'data' => $data
      ];

      return $this->post($this->buildQuery($request));
    }

    public function filterData(string $collection, $headers = []): object
    {
        $request = [
            'path'    => "/_/{$collection}",
            'headers' => $headers,
        ];

        return $this->get($this->buildQuery($request));
    }

    public function DocumentData(string $collection, $Id, $headers = []): object
    {
        $request = [
            'path'    => "/_/{$collection}/{$Id}",
            'headers' => $headers,
        ];

        return $this->get($this->buildQuery($request));
    }

    public function DocumentUpdate(string $collection, string $Id, array $data): object
    {
        $request = [
            'path' => "/_/{$collection}/{$Id}",
            'data' => $data,
        ];
        return $this->put($this->buildQuery($request));
    }

    public function DocumentsUpdate(string $collection, array $data, array $headers = []): object
    {
        $request = [
            'path'    => "/_/$collection",
            'headers' => $headers,
            'data'    => $data,
        ];

        return $this->put($this->buildQuery($request));
    }

    public function DocumentsDelete(string $collection, $headers = []): object
    {
        $request = [
            'path'    => "/_/$collection",
            'headers' => $headers,
        ];
        return $this->delete($this->buildQuery($request));
    }

    public function DocumentDelete(string $collection, string $Id): object
    {
        $request = [
            'path' => "/_/{$collection}/{$Id}",
        ];
        return $this->delete($this->buildQuery($request));
    }

    public function Collections(): object
    {
        $request = [
            'path' => "/_/collections",

        ];
        return $this->get($this->buildQuery($request));
    }

    public function Aggregate(string $collection, array $Instructions): object
    {
        $request = [
            'path' => "/_/aggregate/{$collection}",
            'headers' => [
                'Instructions' => $Instructions,
            ],
        ];
        return $this->patch($this->buildQuery($request));
    }
}
