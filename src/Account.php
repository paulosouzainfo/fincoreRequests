<?php
namespace Fincore;

class Account extends \Fincore\Requests
{
    public function __construct()
    {
        parent::__construct();
    }

    public function UpdatingRegistration(array $data = []): object
    {
        $request = [
            'path' => '/users',
            'data' => $data,
        ];

        return $this->put($this->buildQuery($request));
    }

    public function RecoveringData(): object
    {
        return $this->get('/users');
    }
}
