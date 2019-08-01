<?php
namespace Fincore\Test;

final class AccountTest extends \PHPUnit\Framework\TestCase
{
    private $Account;

    protected function setup(): void
    {
        $this->Account = new \Fincore\Account();
    }

    public function testUpdatingRegistration()
    {
        $data = [
            'password' => getenv('PASSWORD'),
        ];

        $request = $this->Account->UpdatingRegistration($data);

        $this->assertEquals(200, $request->http_status);
        $this->assertEquals(1, $request->response->status->n);
        $this->assertEquals(1, $request->response->status->nModified);
        $this->assertEquals(1, $request->response->status->ok);
        $this->assertEquals(getenv('EMAIL'), $request->response->data->email);
        $this->assertEquals('active', $request->response->data->status);
    }

    public function testRecoveringData(): void
    {
        $request = $this->Account->RecoveringData();
        $arrayRecoveringData = (array)$request->response;

        $this->assertArrayHasKey('email', $arrayRecoveringData);
        $this->assertArrayHasKey('status', $arrayRecoveringData);
        $this->assertArrayHasKey('role', $arrayRecoveringData);
        $this->assertArrayHasKey('age', $arrayRecoveringData);
        $this->assertArrayHasKey('bornAt', $arrayRecoveringData);
        
        $this->assertEquals('active', $arrayRecoveringData['status']);
    }
}
