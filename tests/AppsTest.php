<?php
namespace Fincore\Test;

final class AppsTest extends \PHPUnit\Framework\TestCase
{
  private $apps;

  protected function setup(): void
  {
    $this->apps = new \Fincore\Apps();
  }

  public function testDocumentsCreate(): void
  {
    $data = [
        [
          'name' => 'Juca',
          'lastname' => 'Pirama',
          'age' => rand(12, 100)
        ],
        [
          'name' => 'Tonho',
          'lastname' => 'da Lua',
          'age' => rand(12, 100)
        ],
        [
          'name' => 'Patrícia',
          'lastname' => 'Amaral',
          'age' => rand(12, 100)
        ],
        [
          'name' => 'Roberto',
          'lastname' => 'da Silva',
          'age' => rand(12, 100)
        ],
        [
          'name' => 'Agostinho',
          'lastname' => 'Carrara',
          'age' => rand(12, 100)
        ]
    ];

    $request  = $this->apps->DocumentsCreate('people', $data);

    if(sizeof($request->response)) {
      foreach($request->response as $items) {
        $arrayDoc = (array)$items;

        $this->assertArrayHasKey('name', $arrayDoc);
        $this->assertArrayHasKey('lastname', $arrayDoc);
        $this->assertArrayHasKey('age', $arrayDoc);
        $this->assertArrayHasKey('updatedAt', $arrayDoc);
        $this->assertArrayHasKey('createdAt', $arrayDoc);
        $this->assertArrayHasKey('_id', $arrayDoc);

        $this->assertNotEmpty('name', $items->name);
        $this->assertNotEmpty('lastname', $items->lastname);
        $this->assertNotEmpty('age', $items->age);
        $this->assertNotEmpty('updatedAt', $items->updatedAt);
        $this->assertNotEmpty('createdAt', $items->createdAt);
        $this->assertNotEmpty('_id', $items->_id);
      }
    }

    $this->assertEquals(200, $request->http_status);
  }

  public function testDocumentCreate(): void
  {
    $data = [
      'name' => 'Caipira',
      'lastname' => 'Pira Pora',
      'age' => rand(25, 85)
    ];

    $request  = $this->apps->DocumentsCreate('people', $data);
    $arrayDoc = (array)$request->response;

    $this->assertArrayHasKey('name', $arrayDoc);
    $this->assertArrayHasKey('lastname', $arrayDoc);
    $this->assertArrayHasKey('age', $arrayDoc);
    $this->assertArrayHasKey('updatedAt', $arrayDoc);
    $this->assertArrayHasKey('createdAt', $arrayDoc);
    $this->assertArrayHasKey('_id', $arrayDoc);

    $this->assertNotEmpty('name', $request->response->name);
    $this->assertNotEmpty('lastname', $request->response->lastname);
    $this->assertNotEmpty('age', $request->response->age);
    $this->assertNotEmpty('updatedAt', $request->response->updatedAt);
    $this->assertNotEmpty('createdAt', $request->response->createdAt);
    $this->assertNotEmpty('_id', $request->response->_id);

    $this->assertEquals(200, $request->http_status);
  }

  public function testfilterData(): void
  {
      $headers = [
          'Filter' => [
              'lastname' => 'Amaral',
          ],
      ];

      $request  = $this->apps->filterData('people', $headers);
      $arraydoc = (array)$request->response;

      putenv("PEOPLEID={$request->response->data[0]->_id}");

      $this->assertEquals($headers['Filter']['lastname'], $arraydoc['data'][0]->lastname);
      $this->assertEquals(200, $request->http_status);
  }

  public function testDocumentData(): void
  {
      $request = $this->apps->DocumentData('people', getenv('PEOPLEID'));
      $arrayDoc = (array)$request->response;

      $this->assertEquals($request->response->_id, getenv('PEOPLEID'));
      $this->assertEquals(200, $request->http_status);

      $this->assertArrayHasKey('name', $arrayDoc);
      $this->assertArrayHasKey('lastname', $arrayDoc);
  }

  public function testDocumentsUpdate(): void
  {
      $headers = [
          'Filter' => [
              'lastname' => 'da Silva',
          ],
      ];

      $data = [
          '$set' => [
              'idade'  => '19',
              'status' => 'ativo',
          ],
      ];

      $request = $this->apps->DocumentsUpdate('people', $data, $headers);
      $arrayDoc = (array)$request->response;

      $this->assertEquals($headers['Filter']['lastname'], $request->response->data[0]->lastname);
      $this->assertEquals($data['$set']['idade'], $request->response->data[0]->idade);
      $this->assertEquals($data['$set']['status'], $request->response->data[0]->status);
      $this->assertEquals(200, $request->http_status);
  }

  public function testDocumentUpdate(): void
  {
      $data = [
          '$set' => [
              'idade'  => '30',
              'status' => 'ativo',
              'tipo'   => 'Pai',
          ],
      ];

      $request  = $this->apps->DocumentUpdate('people', getenv('PEOPLEID'), $data);

      $arrayDoc = (array) $request->response;

      $this->assertEquals(1, $arrayDoc['status']->nModified);
      $this->assertEquals($data['$set']['idade'], $arrayDoc['data']->idade);
      $this->assertEquals($data['$set']['status'], $arrayDoc['data']->status);
      $this->assertEquals($data['$set']['tipo'], $arrayDoc['data']->tipo);
  }

  public function testDocumentsDelete(): void
  {
      $headers = [
          'Filter' => [
              'tipo' => 'Pai',
          ],
      ];

      $request = $this->apps->DocumentsDelete('people', $headers);
      $arrayDoc = (array)$request->response;

      $this->assertEquals(200, $request->http_status);
      $this->assertEquals(1, $request->response->result->n);
      $this->assertEquals(1, $request->response->result->ok);
      $this->assertEquals(1, $request->response->deletedCount);
      $this->assertEquals(1, $request->response->n);
      $this->assertEquals(1, $request->response->ok);

      $this->assertArrayHasKey('result', $arrayDoc);
      $this->assertArrayHasKey('connection', $arrayDoc);
      $this->assertArrayHasKey('deletedCount', $arrayDoc);
      $this->assertArrayHasKey('n', $arrayDoc);
      $this->assertArrayHasKey('ok', $arrayDoc);
  }

  public function testCollections(): void
  {
      $request = $this->apps->Collections();

      $this->assertEquals(200, $request->http_status);
  }

  public function testAggregate(): void
  {
    $aggregate = [
      [
        '$match' => [
          'lastname' => 'Pira Pora'
        ]
      ]
    ];

    $request = $this->apps->Aggregate('people', $aggregate);

    $this->assertEquals(200, $request->http_status);

    foreach($request->response as $data) {
      $arrayDoc = (array)$data;

      $this->assertArrayHasKey('_id', $arrayDoc);
      $this->assertArrayHasKey('name', $arrayDoc);
      $this->assertArrayHasKey('lastname', $arrayDoc);
      $this->assertArrayHasKey('age', $arrayDoc);
      $this->assertArrayHasKey('createdAt', $arrayDoc);
      $this->assertArrayHasKey('updatedAt', $arrayDoc);

      $this->assertEquals('Caipira', $data->name);
      $this->assertEquals('Pira Pora', $data->lastname);
    }
  }
}
