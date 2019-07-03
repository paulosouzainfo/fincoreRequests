<?php
namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class AccountTest extends \PHPUnit\Framework\TestCase {
	private $Account;
	
	protected function setup(): void {
		$this->Account = new \Fincore\Account();
   }

   public function testRecoveringData(): void {
   	$request = $this->Account->RecoveringData();
   	$this->assertEquals(200, $request->http_status);
	}

}
