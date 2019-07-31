<?php
namespace Fincore\Test;

final class AppsTest extends \PHPUnit\Framework\TestCase
{
    protected function setup(): void
    {
        $this->Apps = new \Fincore\Apps();

    }

    public function testDocumentsUpdate(): void
    {
        $headers = [
            'Filter' => [
                'tipo' => 'PAi',
            ],
        ];

        $data = [
            '$set' => [
                'idade'  => '19',
                'status' => 'ativo',
            ],
        ];

        $request  = $this->Apps->DocumentsUpdate(getenv('COLLECTION'), $data, $headers);
        $arrayDoc = (array) $request->response;

        $this->assertEquals(1, $arrayDoc['status']->nModified);
        $this->assertEquals($headers['Filter']['tipo'], $arrayDoc['data'][0]->tipo);
        $this->assertEquals($data['$set']['idade'], $arrayDoc['data'][0]->idade);
        $this->assertEquals($data['$set']['status'], $arrayDoc['data'][0]->status);
        $this->assertEquals(200, $request->http_status);
    }

    public function testDocumentUpdate(): void
    {
        $data = [
            '$set' => [
                'idade'  => '30',
                'status' => 'atualizado',
                'tipo'   => 'Pai',
            ],
        ];

        $request  = $this->Apps->DocumentUpdate(getenv('COLLECTION'), getenv('ID'), $data);
        $arrayDoc = (array) $request->response;

        $this->assertEquals(1, $arrayDoc['status']->nModified);
        $this->assertEquals($data['$set']['idade'], $arrayDoc['data']->idade);
        $this->assertEquals($data['$set']['status'], $arrayDoc['data']->status);
        $this->assertEquals($data['$set']['tipo'], $arrayDoc['data']->tipo);
    }

    public function testCollections(): void
    {
        $request = $this->Apps->Collections();

        $this->assertCount(5, $request->response);
        $this->assertEquals(200, $request->http_status);

        $arrayCollections = (array) $request->response[0];

        $this->assertArrayHasKey('name', $arrayCollections);
        $this->assertArrayHasKey('type', $arrayCollections);
        $this->assertEquals('fotos', $arrayCollections['name']);
        $this->assertEquals('collection', $arrayCollections['type']);
    }

    public function testDocumentCreate(): void
    {
        $data = [
            'name'     => 'David',
            'lastname' => 'Brasil',
            'age'      => '44',
        ];

        $request  = $this->Apps->DocumentCreate('people', $data);
        $arrayDoc = (array) $request->response;

        $this->assertEquals($data['name'], $arrayDoc['name']);
        $this->assertEquals($data['lastname'], $arrayDoc['lastname']);
        $this->assertEquals($data['age'], $arrayDoc['age']);
        $this->assertEquals(200, $request->http_status);
    }

    public function testDocumentsDelete(): void
    {
        $headers = [
            'Filter' => [
                'tipo' => 'pai',
            ],
        ];

        $request = $this->Apps->DocumentsDelete(getenv('COLLECTION'), $headers);
        $this->assertEquals(200, $request->http_status);
    }

    public function testDocumentDelete(): void
    {
        $request  = $this->Apps->DocumentDelete(getenv('COLLECTION'), getenv('ID'));
        $arrayDel = (array) $request->response;

        $this->assertEquals(1, $arrayDel['n']);
        $this->assertEquals(1, $arrayDel['ok']);
        $this->assertEquals(200, $request->http_status);
    }

    public function testfilterData(): void
    {
        $headers = [
            'Filter' => [
                'lastname' => 'brasil11',
            ],
        ];

        $request  = $this->Apps->filterData(getenv('COLLECTION'), $headers);
        $arraydoc = (array) $request->response;

        $this->assertEquals($headers['Filter']['lastname'], $arraydoc['data'][0]->lastname);
        $this->assertEquals(1, $arraydoc['docs']);
        $this->assertEquals(200, $request->http_status);
    }

    public function testDocumentData(): void
    {
        $request = $this->Apps->DocumentData(getenv('COLLECTION'), getenv('ID'));

        $this->assertEquals($request->response->_id, getenv('ID'));
        $this->assertEquals(200, $request->http_status);
    }

    public function testTokenChecker(): void
    {
        $request = $this->Apps->TokenChecker();
        $this->assertEquals(200, $request->http_status);
    }
}
