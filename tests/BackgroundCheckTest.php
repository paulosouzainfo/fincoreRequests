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

    public function testDocuments(): void
    {
        $imageURL = getenv('FRENTE');
        $type     = getenv('TIPO');
        $side     = getenv('SIDE');
        $request  = $this->BackgroundCheck->documents($imageURL, $type, $side);
        $this->assertEquals(200, $request->http_status);
    }

    public function testquestion(): void
    {
        $document = getenv('CPF');
        $request  = $this->BackgroundCheck->question($document);
        $this->assertEquals(200, $request->http_status);
    }

    public function testanswers(): void
    {
        $ticket  = getenv('TICKET');
        $answers = array('0', '2', '0', '2');
        $request = $this->BackgroundCheck->answers($ticket, $answers);
        $this->assertEquals(200, $request->http_status);

    }

    public function testFacematch(): void
    {
        $frente  = getenv('FRENTE');
        $selfie  = getenv('SELFIE');
        $request = $this->BackgroundCheck->facematch($frente, $selfie);
        $this->assertEquals(200, $request->http_status);

    }
}
