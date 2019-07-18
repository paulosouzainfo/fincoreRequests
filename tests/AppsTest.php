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
        $headers = [
            'Filter'  => [
              'tipo' => 'Filho'
            ],
            'Options' => [
              'multi' => true
            ]
        ];
        
        $data = [
            '$set' => [
                'idade' => '50',
                'status' => 'ativo'
            ]
        ];

        $request = $this->Apps->DocumentsUpdate('familia', $data, $headers);
        var_dump($request);
    }

}
