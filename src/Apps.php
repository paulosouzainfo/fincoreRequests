<?php
namespace Fincore;

class Apps extends \Fincore\Requests
{
    public function __construct()
    {
        parent::__construct();
    }
    public function Aggregate(string $Instructions): object
    {
        $request = [
            'path' => "/_/aggregate",
            'data' => [
                'Instructions' => $Instructions,
            ],
        ];
        return $this->patch($this->buildQuery($request));
    }

    public function DocumentsUpdate(string $collection,
        array $Filter = [], array $Options = []) {
        $request = [
            'path' => "/_/{$collection}",
            'data' => [
                'Filter'  => $Filter,
                'Options' => $Options,
            ],
        ];

        return $this->put($this->buildQuery($request));
    }

    public function DocumentUpdate(string $collection, $Id
        array $Filter = [], array $Options = []): object{
        $request = [
            'path' => "/_/{$collection}/{$Id}",
            'data' => [
                'Filter'  => $Filter,
                'Options' => $Options,
            ],
        ];
        return $this->put($this->buildQuery($request));
    }
    public function Collection(string $collection,
        array $Filter = [], array $Options = []): object{
        $request = [
            'path' => "/_/{$collection}",
            'data' => [
                'Filter'  => $Filter,
                'Options' => $Options,
            ],
        ];
        return $this->put($this->buildQuery($request));
    }

    public function CollectionId(string $collection, string $Id,
        $Options = []): object{
        $request = [
            'path' => "/_/{$collection}/{$Id}",
            'data' => [
                'Options' => $Options,
            ],
        ];
        return $this->put($this->buildQuery($request));
    }

    public function ListCollection(): object
    {
        $request = [
            'path' => "/_/collection",
        ];
        return $this->get($this->buildQuery($request));
    }
    public function CreateDocument(string $collection, array $data): object
    {
        $request = [
            'path' => "/_/{$collection}",
            'data' => $data,
        ];
        return $this->post($this->buildQuery($request));
    }

    public function DocumentsDelete(string $collection, string $filter = []): object
    {
        $request = [
            'path' => "/_/{$collection}",
            'data' => $filter,
        ];
        return $this->delete($this->buildQuery($request));
    }

    public function DocumentDelete(string $collection, string $option = []): object
    {
        $request = [
            'path' => "/_/{$collection}",
            'data' => $option,

        ];
        return $this->delete($this->buildQuery($request));
    }

    public function filterData(string $collection, string $Filter = [], string $option = []): object
    {
        $request = [
            'path'    => "/_/{$collection}",
            'Filter'  => $Filter,
            'Options' => $Options,
        ];
        return $this->get($this->buildQuery($request));
    }

    public function DocumentData(string $collection, string $id, string $Filter = [], string $option = []): object
    {
        $request = [
            'path'    => "/_/{$collection}/{$id}",
            'Filter'  => $Filter,
            'Options' => $Options,
        ];
        return $this->get($this->buildQuery($request));
    }

    public function TokenChecker(): object
    {
        $request = [
            'path' => "/auth",
        ];
        return $this->head($this->buildQuery($request));

    }
}
