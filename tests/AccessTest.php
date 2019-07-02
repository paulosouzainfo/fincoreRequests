<?php
namespace Fincore\Test;

final class AccessTest extends \PHPUnit\Framework\TestCase {
	private $access;
	
	protected function setup(): void {
		$this->access = new \Fincore\Access();
  }

	public function senhaAleatoria(): array {
    return [
      ['email@email.com', 'mypassword'],
      ['meunovo@email.com', 'mysenha'],
      ['pepe@gamil.co', 'teste'],
      ['pepe', 'teste']
    ];
  }
	
	/**
	* @dataProvider senhaAleatoria
	*/
	public function testVerificarAcesso($email, $password): void {
		$request = $this->access->administrative($email,$password);
		
		$this->assertEquals(200, $request->http_status);
		$this->assertEquals($email, $request->response->email);
	}
}
