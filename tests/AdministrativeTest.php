<?php
namespace Fincore\Test;

final class AdministrativeTest extends \PHPUnit\Framework\TestCase
{
    private $Administrative;

    protected function setup(): void
    {
        $this->Administrative = new \Fincore\Administrative();
    }

    public function testListApps(): void
    {
        $request = $this->Administrative->ListApps();

        $this->assertEquals(200, $request->http_status);

        if(sizeof($request->response)) {
          foreach($request->response as $application) {
            $arrayList = (array)$application;

            $this->assertArrayHasKey('url', $arrayList);
            $this->assertArrayHasKey('dsn', $arrayList);
            $this->assertArrayHasKey('user_id', $arrayList);
            $this->assertArrayHasKey('updatedAt', $arrayList);
            $this->assertArrayHasKey('createdAt', $arrayList);
            $this->assertArrayHasKey('token', $arrayList);

            $this->assertNotEmpty($application->url);
            $this->assertNotEmpty($application->dsn);
            $this->assertNotEmpty($application->user_id);
            $this->assertNotEmpty($application->updatedAt);
            $this->assertNotEmpty($application->createdAt);
            $this->assertNotEmpty($application->token);

            // setando na ENV dinamicamente o ID da APP para o próximo teste
            putenv("ApplicationID={$application->_id}");
          }
        }
    }

    public function testRetrieveApp(): void
    {
      $id = getenv('ApplicationID');

      $request = $this->Administrative->RetrieveApp($id);
      $arrayList = (array)$request->response;

      $this->assertArrayHasKey('_id', $arrayList);
      $this->assertArrayHasKey('url', $arrayList);
      $this->assertArrayHasKey('dsn', $arrayList);
      $this->assertArrayHasKey('user_id', $arrayList);
      $this->assertArrayHasKey('updatedAt', $arrayList);
      $this->assertArrayHasKey('createdAt', $arrayList);
      $this->assertArrayHasKey('token', $arrayList);

      $this->assertNotEmpty($request->response->url);
      $this->assertNotEmpty($request->response->dsn);
      $this->assertNotEmpty($request->response->user_id);
      $this->assertNotEmpty($request->response->updatedAt);
      $this->assertNotEmpty($request->response->createdAt);
      $this->assertNotEmpty($request->response->token);

      $this->assertEquals($id, $request->response->_id);
      $this->assertEquals(200, $request->http_status);
    }

    public function testNewApp(): void
    {
      $identity = preg_replace('/[^0-9]/', '', time());

      putenv("URL=https://{$identity}.fincore.co");
      putenv("DSN=mongodb://localhost:27017/{$identity}");

      $request = $this->Administrative->NewApp(getenv('URL'), getenv('DSN'));
      $arrayList = (array)$request->response;

      $this->assertArrayHasKey('_id', $arrayList);
      $this->assertArrayHasKey('url', $arrayList);
      $this->assertArrayHasKey('dsn', $arrayList);
      $this->assertArrayHasKey('user_id', $arrayList);
      $this->assertArrayHasKey('updatedAt', $arrayList);
      $this->assertArrayHasKey('createdAt', $arrayList);
      $this->assertArrayHasKey('token', $arrayList);

      $this->assertNotEmpty($request->response->_id);
      $this->assertNotEmpty($request->response->url);
      $this->assertNotEmpty($request->response->dsn);
      $this->assertNotEmpty($request->response->user_id);
      $this->assertNotEmpty($request->response->createdAt);
      $this->assertNotEmpty($request->response->updatedAt);
      $this->assertNotEmpty($request->response->token);

      $this->assertEquals(getenv('URL'), $request->response->url);
      $this->assertEquals(getenv('DSN'), str_replace(' ', '+', $request->response->dsn));
      $this->assertEquals(200, $request->http_status);
    }

    public function testDisableApps(): void
    {
      $id = getenv('ApplicationID');

      $request = $this->Administrative->DisableApps($id);
      $arrayDisable = (array)$request->response;

      $this->assertArrayHasKey('nModified', $arrayDisable);
      $this->assertArrayHasKey('n', $arrayDisable);
      $this->assertArrayHasKey('ok', $arrayDisable);

      $this->assertEquals(1, $request->response->nModified);
      $this->assertEquals(1, $request->response->n);
      $this->assertEquals(1, $request->response->ok);

      $this->assertEquals(200, $request->http_status);
    }

    public function testReactivatingApps(): void
    {
      $id = getenv('ApplicationID');

      $request = $this->Administrative->ReactivatingApps($id);
      $arrayDisable = (array)$request->response;

      $this->assertArrayHasKey('nModified', $arrayDisable);
      $this->assertArrayHasKey('n', $arrayDisable);
      $this->assertArrayHasKey('ok', $arrayDisable);

      $this->assertEquals(1, $request->response->nModified);
      $this->assertEquals(1, $request->response->n);
      $this->assertEquals(1, $request->response->ok);

      $this->assertEquals(200, $request->http_status);
    }

    public function testUpdatingApps(): void
    {
      list($url, $dsn, $appId) = [getenv('URL'), getenv('DSN'), getenv('ApplicationID')];

      $request = $this->Administrative->UpdatingApps($url, $dsn, $appId);
      $arrayUpdating = (array)$request->response;

      $this->assertArrayHasKey('nModified', $arrayUpdating);
      $this->assertArrayHasKey('n', $arrayUpdating);
      $this->assertArrayHasKey('ok', $arrayUpdating);

      $this->assertEquals(1, $request->response->nModified);
      $this->assertEquals(1, $request->response->n);
      $this->assertEquals(1, $request->response->ok);

      $this->assertEquals(200, $request->http_status);
    }
}
