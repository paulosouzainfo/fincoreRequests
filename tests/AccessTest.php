<?php
namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class AccessTest extends \PHPUnit\Framework\TestCase
{
    private $access;

    protected function setup(): void
    {
        $this->access = new \Fincore\Access();
    }

    public function senhaAleatoria(): array
    {
        return [
            [getenv('EMAIL'), getenv('PASSWORD')],
        ];
    }

    /**
     * @dataProvider senhaAleatoria
     */
    public function testInputAdministrativo($email, $password): void
    {
        $this->assertEquals($email, filter_var($email, FILTER_VALIDATE_EMAIL));
        $this->assertTrue(strlen($password) >= 6);
    }
    /**
     * @dataProvider senhaAleatoria
     */
    public function testResponseAdministrativo($email, $password): void
    {
        $request             = $this->access->Administrative($email, $password);
        $arrayAdministrativo = (array) $request->response;
        $this->assertArrayHasKey('email', $arrayAdministrativo);
        $this->assertArrayHasKey('status', $arrayAdministrativo);
        $this->assertArrayHasKey('role', $arrayAdministrativo);
        $this->assertArrayHasKey('zodiacSign', $arrayAdministrativo);
        $this->assertArrayHasKey('chineseSign', $arrayAdministrativo);
        $this->assertArrayHasKey('age', $arrayAdministrativo);
        $this->assertArrayHasKey('bornAt', $arrayAdministrativo);
        $this->assertArrayHasKey('createdAt', $arrayAdministrativo);
        $this->assertEquals($email, $arrayAdministrativo['email']);
        $this->assertEquals('active', $arrayAdministrativo['status']);
        $this->assertEquals('admin', $arrayAdministrativo['role']);
        $this->assertEquals('CANCER', $arrayAdministrativo['zodiacSign']);
        $this->assertEquals('Tiger', $arrayAdministrativo['chineseSign']);
        $this->assertEquals('44', $arrayAdministrativo['age']);
        $this->assertEquals('1974-07-21', date("Y-m-d", strtotime($arrayAdministrativo['bornAt'])));
        $this->assertEquals('2019-06-24', date("Y-m-d", strtotime($arrayAdministrativo['createdAt'])));
        $this->assertEquals(200, $request->http_status);

    }
    public function InfoDadosApps(): array
    {
        return [
            [getenv('SECRET'), getenv('USERID'), getenv('TOKEN')],
        ];
    }
    /**
     * @dataProvider InfoDadosApps
     */
    public function testApps($secret, $userID, $token): void
    {
        $request = $this->access->Apps($secret, $userID, $token);
        $this->assertEquals(200, $request->http_status);
        $this->assertEquals($userID, $request->response->user_id);
        $this->assertEquals($token, $request->response->token);
    }
}
