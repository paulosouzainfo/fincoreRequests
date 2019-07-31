<?php
namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

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
            'nickName' => getenv('NICKNAME'),
        ];

        $request = $this->Account->UpdatingRegistration($data);
        $this->assertEquals(200, $request->http_status);
    }

    public function testRecoveringData(): void
    {
        $request             = $this->Account->RecoveringData();
        $arrayRecoveringData = (array) $request->response;
        
        $this->assertArrayHasKey('email', $arrayRecoveringData);
        $this->assertArrayHasKey('status', $arrayRecoveringData);
        $this->assertArrayHasKey('role', $arrayRecoveringData);
        $this->assertArrayHasKey('zodiacSign', $arrayRecoveringData);
        $this->assertArrayHasKey('chineseSign', $arrayRecoveringData);
        $this->assertArrayHasKey('age', $arrayRecoveringData);
        $this->assertArrayHasKey('bornAt', $arrayRecoveringData);
        $this->assertArrayHasKey('createdAt', $arrayRecoveringData);
        $this->assertEquals('active', $arrayRecoveringData['status']);
        $this->assertEquals('admin', $arrayRecoveringData['role']);
        $this->assertEquals('CANCER', $arrayRecoveringData['zodiacSign']);
        $this->assertEquals('Tiger', $arrayRecoveringData['chineseSign']);
        $this->assertEquals('44', $arrayRecoveringData['age']);
        $this->assertEquals('1974-07-21', date("Y-m-d", strtotime($arrayRecoveringData['bornAt'])));
        $this->assertEquals('2019-06-24', date("Y-m-d", strtotime($arrayRecoveringData['createdAt'])));
    }
}
