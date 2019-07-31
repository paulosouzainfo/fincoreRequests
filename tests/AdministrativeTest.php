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

        $this->assertCount(2, $request->response);
        $this->assertArrayHasKey('url', $arrayList);
        $this->assertArrayHasKey('dsn', $arrayList);
        $this->assertArrayHasKey('user_id', $arrayList);
        $this->assertArrayHasKey('updatedAt', $arrayList);
        $this->assertArrayHasKey('createdAt', $arrayList);
        $this->assertArrayHasKey('token', $arrayList);
        $this->assertNotEmpty($arrayList['url']);
        $this->assertNotEmpty($arrayList['dsn']);
        $this->assertNotEmpty($arrayList['user_id']);
        $this->assertNotEmpty($arrayList['updatedAt']);
        $this->assertNotEmpty($arrayList['createdAt']);
        $this->assertNotEmpty($arrayList['token']);
        $this->assertEquals(200, $request->http_status);
    }

    public function ID(): array
    {
        return [
            [getenv('IDAPP')],
        ];
    }
    /**
     * @dataProvider ID
     */
    public function testRetrieveApp($id): void
    {
        $request = $this->Administrative->RetrieveApp($id);

        $arrayID = (array) $request->response;

        $this->assertArrayHasKey('_id', $arrayID);
        $this->assertArrayHasKey('url', $arrayID);
        $this->assertArrayHasKey('dsn', $arrayID);
        $this->assertArrayHasKey('user_id', $arrayID);
        $this->assertArrayHasKey('updatedAt', $arrayID);
        $this->assertArrayHasKey('createdAt', $arrayID);
        $this->assertArrayHasKey('token', $arrayID);
        $this->assertNotEmpty($arrayID['url']);
        $this->assertNotEmpty($arrayID['dsn']);
        $this->assertNotEmpty($arrayID['user_id']);
        $this->assertNotEmpty($arrayID['updatedAt']);
        $this->assertNotEmpty($arrayID['createdAt']);
        $this->assertNotEmpty($arrayID['token']);
        $this->assertEquals($id, $arrayID['_id']);
        $this->assertEquals(200, $request->http_status);
    }

    public function Novoapp(): array
    {
        return [
            [getenv('URL'), getenv('DSN')],
        ];
    }/**
     * @dataProvider Novoapp
     */
    public function testNewApp($url, $dsn): void
    {
        $request = $this->Administrative->NewApp($url, $dsn);

        $arrayNew = (array) $request->response;

        $this->assertArrayHasKey('url', $arrayNew);
        $this->assertArrayHasKey('dsn', $arrayNew);
        $this->assertArrayHasKey('user_id', $arrayNew);
        $this->assertArrayHasKey('updatedAt', $arrayNew);
        $this->assertArrayHasKey('createdAt', $arrayNew);
        $this->assertArrayHasKey('token', $arrayNew);
        $this->assertNotEmpty($arrayNew['url']);
        $this->assertNotEmpty($arrayNew['dsn']);
        $this->assertNotEmpty($arrayNew['user_id']);
        $this->assertNotEmpty($arrayNew['createdAt']);
        $this->assertNotEmpty($arrayNew['updatedAt']);
        $this->assertNotEmpty($arrayNew['token']);
        $this->assertEquals($url, $arrayNew['url']);
        $this->assertEquals($dsn, $arrayNew['dsn']);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider ID
     */

    public function testDisableApps($appId): void
    {
        $request      = $this->Administrative->DisableApps($appId);
        $arrayDisable = (array) $request->response;

        $this->assertArrayHasKey('nModified', $arrayDisable);
        $this->assertNotEmpty($arrayDisable['nModified']);
        $this->assertEquals(1, $arrayDisable['nModified']);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider ID
     */
    public function testReactivatingApps($appId): void
    {
        $request           = $this->Administrative->ReactivatingApps($appId);
        $arrayReactivating = (array) $request->response;

        $this->assertArrayHasKey('nModified', $Reactivating);
        $this->assertNotEmpty($Reactivating['nModified']);
        $this->assertEquals(1, $Reactivating['nModified']);
        $this->assertEquals(200, $request->http_status);
        $this->assertEquals(200, $request->http_status);
    }

    public function UpdateApp(): array
    {
        return [
            [getenv('URL'), getenv('DSN'), getenv('IDAPP')],
        ];
    }
    /**
     * @dataProvider UpdateApp
     */
    public function testUpdatingApps($url, $dsn, $appId): void
    {
        $request       = $this->Administrative->UpdatingApps($url, $dsn, $appId);
        $arrayUpdating = (array) $request->response;

        $this->assertArrayHasKey('nModified', $arrayUpdating);
        $this->assertNotEmpty($arrayUpdating['nModified']);
        $this->assertEquals(1, $arrayUpdating['nModified']);
        $this->assertEquals(200, $request->http_status);
    }
}
