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
    /* public function testDocumentsUpdate()
    {
    $headers = [
    'Filter' => [
    'tipo' => 'Filho',
    ],
    ];

    $data = [
    '$set' => [
    'idade'  => '150',
    'status' => 'ativo',
    ],
    ];
    $request = $this->Apps->DocumentsUpdate(getenv('COLLECTION'), $data, $headers);
    $this->assertEquals(200, $request->http_status);
    }*/

    /*public function testDocumentUpdate()
    {
    $data = [
    '$set' => [
    'idade'  => '30',
    'status' => 'atualizado',
    ],
    ];
    $request = $this->Apps->DocumentUpdate(getenv('COLLECTION'), '5d2cfb28c9a6ed2f535bc905',$data);
    var_dump($request);
    }

    /*public function testCollections()
    {
    $request = $this->Apps->Collections();
    $this->assertEquals(200, $request->http_status);
    }*/

    /*  public function CollectionId() {

    }*/

    /*  public function testDocumentCreate()
    {
    $data = [
    'name'     => 'Will',
    'lastname' => 'John',
    'age'      => '11',
    ];
    $request = $this->Apps->DocumentCreate('people', $data);
    $this->assertEquals(200, $request->http_status);
    }*/

    /* public function testDocumentsDelete()
    {
    $headers = [
    'Filter' => [
    'tipo' => 'Avô'
    ],
    ];
    $request = $this->Apps->DocumentsDelete(getenv('COLLECTION'), $headers);
    $this->assertEquals(200, $request->http_status);
    }*/

    /*public function testDocumentDelete()
    {
    $request = $this->Apps->DocumentDelete(getenv('COLLECTION'), getenv('ID'));
    $this->assertEquals(200, $request->http_status);

    }*/

    /*public function testfilterData(): object
    {
    $headers = [
    'Filter' => [
    'idade' => 32
    ],
    ];
    $request = $this->Apps->filterData(getenv('COLLECTION'));
    $this->assertEquals(200, $request->http_status);

    }*/
   /* public function testDocumentData(): object
    {
        $headers = [
            'Filter' => [
                'tipo' => 'Mãe',
            ],
        ];
        $request = $this->Apps->DocumentData(getenv('COLLECTION'), getenv('ID'),$headers);
        var_dump($request);
    }*/

    public function testTokenChecker()
    {
        
        $request = $this->Apps->TokenChecker();
        var_dump($request);

    }

}
