<?php

namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class UtilitiesTest extends \PHPUnit\Framework\TestCase
{
    private $Json;
    protected function setup(): void
    {
        $this->Json     = new \Fincore\Utilities();
        

    }

    public function testJsonToXls(): void
    {
    	$data = [['a' => 1], ['b' => 2], ['c' => 3], ['d' => 4], ['e' => 5]];
        $request = $this->Json->JsonToXls($data);
        $this->assertEquals(200, $request->http_status);       
    }
}
