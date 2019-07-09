<?php
namespace Fincore;

class Utilities extends \Fincore\Requests
{
    public function __construct()
    {
        parent::__construct();
    }

    public function testJsonToXls($json)
    {
        $request = [
            'path' => '/json-to-xls',
            'data' => $json
        ];

        return $this->post($this->buildQuery($request));
    }
}
