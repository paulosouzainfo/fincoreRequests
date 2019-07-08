<?php

namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class PJTest extends \PHPUnit\Framework\TestCase
{

    private $PJ;
    protected function setup(): void
    {
        $this->PJ = new \Fincore\PJ();
    }
    public function Cnpj(): array
    {
        return [
            [getenv('CNPJ')],
        ];
    }
    /**
     * @dataProvider Cnpj
     */

    /* public function testads($cnpj): void
    {

    $request = $this->PJ->ads($cnpj);
    $this->assertEquals(200, $request->http_status);

    }*/
    /**
     * @dataProvider Cnpj
     */
    /* public function testbasic($cnpj): void
    {
    $request = $this->PJ->basic($cnpj);
    $this->assertEquals(200, $request->http_status);
    }*/
    /**
     * @dataProvider Cnpj
     */
    /*public function testdomains($cnpj): void
    {
    $request = $this->PJ->domains($cnpj);

    $this->assertEquals(200, $request->http_status);

    }*/
    /**
     * @dataProvider Cnpj
     */
    public function testemails($cnpj): void
    {
        $request = $this->PJ->emails($cnpj);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider Cnpj
     */
    /* public function testmediaExposure($cnpj): void
    {
    $request = $this->PJ->mediaExposure($cnpj);
    $this->assertEquals(200, $request->http_status);
    }*/
    /**
     * @dataProvider Cnpj
     */
    public function testactivityIndicators($cnpj): void
    {

        $request = $this->PJ->activityIndicators($cnpj);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider Cnpj
     */
    public function testrelationships($cnpj): void
    {

        $request = $this->PJ->relationships($cnpj);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider Cnpj
     */
    public function testphones($cnpj): void
    {
        $request = $this->PJ->relationships($cnpj);
        $this->assertEquals(200, $request->http_status);
    }
}
