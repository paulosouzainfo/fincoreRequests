<?php
namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();
final class BackgroundCheckTest extends \PHPUnit\Framework\TestCase
{
    private $BackgroundCheck;
    protected function setup(): void
    {
        $this->BackgroundCheck = new \Fincore\BackgroundCheck();
    }
    public function CPF(): array
    {
        return [
            [getenv('CPF')],
        ];
    }
    /**
     * @dataProvider CPF
     */
    public function testquestion($document): void
    {
        $request = $this->BackgroundCheck->question($document);
        $this->assertEquals(200, $request->http_status);
    }
    public function testanswers($ticket, $answers): void
    {
        $request = $this->BackgroundCheck->answers($ticket, $answers);
        $this->assertEquals(200, $request->http_status);
    }
    public function testdocuments($imageURL, $type, $side): void
    {
        $request = $this->BackgroundCheck->documents($imageURL, $type, $side);
        $this->assertEquals(200, $request->http_status);
    }
    public function testfacematch($documentURL, $selfieURL): void
    {
        $request = $this->BackgroundCheck->facematch($documentURL, $selfieURL);
        $this->assertEquals(200, $request->http_status);
    }
}
