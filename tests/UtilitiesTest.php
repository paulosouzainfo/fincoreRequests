<?php

namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class UtilitiesTest extends \PHPUnit\Framework\TestCase
{
    private $Json;
    protected function setup(): void
    {
        $this->Json = new \Fincore\Utilities();

    }

    public function testJsonToXls(): void
    {
        $request = $this->Json->JsonToXls();

    }
}
