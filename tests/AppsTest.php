<?php

namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class AppsTest extends \PHPUnit\Framework\TestCase
{

    protected function setup(): void
    {
        $this->Apps = new \Fincore\Apps();
    }
    public function testDocumentsUpdate()
    {
        $collection = getenv('COLLECTION');
        //$filter     = 'Filter:' . json_encode(['tipo' => 'Filho']);
        $headers = [
            'filter'  => ['tipo' => 'Filho'],
            'options' => ['multi' => true]
        ]
        $data = [
            '$set' => [
                'idade' => '50',
            ],
        ];

        $request = $this->Apps->DocumentsUpdate($collection, $data, $filter);
        var_dump($request);

    }

}
