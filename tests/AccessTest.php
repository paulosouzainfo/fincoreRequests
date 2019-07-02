<?php
namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class AccessTest extends \PHPUnit\Framework\TestCase {
	private $access;
	
	protected function setup(): void {
		$this->access = new \Fincore\Access();
  }

	public function senhaAleatoria(): array {
    return [
      [getenv('EMAIL'), getenv('PASSWORD')]
    ];
  }
	
	/**
	* @dataProvider senhaAleatoria
	*/
	public function testVerificarAcesso($email, $password): void {
		$this->assertEquals($email, filter_var($email, FILTER_VALIDATE_EMAIL));
		$this->assertTrue(strlen($password) >= 6);
		
		$request = $this->access->administrative($email,$password);
		
		$this->assertEquals(200, $request->http_status);
		$this->assertEquals($email, $request->response->email);
	}
}
