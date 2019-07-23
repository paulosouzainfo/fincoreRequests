<?php

namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class PhonesTest extends \PHPUnit\Framework\TestCase
{
    private $Phones;
    protected function setup(): void
    {
        $this->Phones = new \Fincore\Phones();
    }
    public function phone(): array
    {
        return [
            [getenv('PHONE')],
        ];
    }
    /**
     * @dataProvider phone
     */
    /*public function testPhonesHistory($phone)
    {
        $request = $this->Phones->PhonesHistory($phone);
       
        //$this->assertEquals(200, $request->http_status);
    }*/
    /**
     * @dataProvider phone
     */
    /*public function testPhoneData($phone)
    {
        $request = $this->Phones->PhoneData($phone);
        var_dump($request);
        $this->assertEquals(200, $request->http_status);

    }*/
}
