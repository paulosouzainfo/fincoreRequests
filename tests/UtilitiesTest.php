<?php

namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class UtilitiesTest extends \PHPUnit\Framework\TestCase
{
    private $Utilities;
    protected function setup(): void
    {
        $this->Utilities = new \Fincore\Utilities();
    }
    public function testJsonToXls()
    {
        $data    = ['a' => 1, 'b' => 1];
        $request = $this->Utilities->JsonToXls($data);        
        $this->assertEquals(200, $request->http_status);
    }
}
