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

    public function testdocuments(): void
    {
        $imageURL = getenv('URL_IMAGE');
        $type     = getenv('TIPO');
        $side     = getenv('SIDE');
        $request  = $this->BackgroundCheck->documents($imageURL, $type, $side);
        $this->assertEquals(200, $request->http_status);
    }

    /* public function testquestion(): void
{
$document = getenv('CPF');
$request  = $this->BackgroundCheck->question($document);
$this->assertEquals(200, $request->http_status);
}

public function testfacematch(): void
{

$frente  = getenv('FRENTE');
$self    = getenv('SELF');
$request = $this->BackgroundCheck->facematch($frente, $self);
var_dump($request);
//  $this->assertEquals(200, $request->http_status);
}*/
}
