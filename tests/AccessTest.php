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
        $request = $this->access->Administrative($email, $password);

        $this->assertEquals(200, $request->http_status);
        $this->assertEquals($email, $request->response->email);
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
    }
}
