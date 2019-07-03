<?php
namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class AccessHelperTest extends \PHPUnit\Framework\TestCase {
	private $access;
	
	protected function setup(): void {
		$this->access = new \Fincore\AccessHelper();
   }

  public function InfoEmail(): array {
    return [
      [getenv('EMAIL')]
    ];
  }
  /**
  * @dataProvider InfoEmail
  */
   public function testforgot($email) {
    $request = $this->access->forgot($email);
    $this->assertEquals(200, $request->http_status);
   }
}
