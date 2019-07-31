<?php
namespace Fincore\Test;

final class AccessHelperTest extends \PHPUnit\Framework\TestCase
{
    private $access;

    protected function setup(): void
    {
        $this->access = new \Fincore\AccessHelper();
    }

    public function testForgot()
    {
      $email = getenv('EMAIL');

      $request = $this->access->forgot($email);

      $this->assertEquals(200, $request->http_status);
      $this->assertEquals(true, strpos($request->response, $email));
    }
}
