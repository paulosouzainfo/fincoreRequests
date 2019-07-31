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

        $arrayDoc = (array) $request->response;

        $this->assertArrayHasKey('createdAt', $arrayDoc);
        $this->assertArrayHasKey('updatedAt', $arrayDoc);
        $this->assertArrayHasKey('document', $arrayDoc);
        $this->assertArrayHasKey('type', $arrayDoc);
        $this->assertArrayHasKey('side', $arrayDoc);
        $this->assertArrayHasKey('BIRTHDATE', $arrayDoc);
        $this->assertArrayHasKey('CPF', $arrayDoc);
        $this->assertArrayHasKey('DOCTYPE', $arrayDoc);
        $this->assertArrayHasKey('EXPEDITIONDATE', $arrayDoc);
        $this->assertArrayHasKey('FATHERNAME', $arrayDoc);
        $this->assertArrayHasKey('MOTHERNAME', $arrayDoc);
        $this->assertArrayHasKey('NAME', $arrayDoc);
        $this->assertEquals(200, $request->http_status);
        $this->assertEquals('2019-07-26', date("Y-m-d", strtotime($arrayDoc['createdAt'])));
        $this->assertEquals('2019-07-26', date("Y-m-d", strtotime($arrayDoc['updatedAt'])));
        $this->assertEquals($imageURL, $arrayDoc['document']);
        $this->assertEquals($type, $arrayDoc['type']);
        $this->assertEquals($side, $arrayDoc['side']);
        $this->assertEquals('21/07/1974', $arrayDoc['BIRTHDATE']);
        $this->assertNotEmpty($arrayDoc['CPF']);
        $this->assertEquals('RG', $arrayDoc['DOCTYPE']);
        $this->assertEquals('08/07/2002', $arrayDoc['EXPEDITIONDATE']);
        $this->assertNotEmpty($arrayDoc['FATHERNAME']);
        $this->assertNotEmpty($arrayDoc['MOTHERNAME']);
        $this->assertNotEmpty($arrayDoc['NAME']);
    }

    public function testquestion(): void
    {
        $document          = getenv('CPF');
        $request           = $this->BackgroundCheck->question($document);

        $arrayTestquestion = $request->response;

        $this->assertNotEmpty($arrayTestquestion->TicketId);
        $this->assertCount(4, $arrayTestquestion->Questions);
        $document = preg_replace("/[^0-9]/", "", $document);
        $this->assertEquals($document, $arrayTestquestion->document);
        $this->assertEquals(200, $request->http_status);
    }

    public function testanswers(): void
    {
        $ticket  = getenv('TICKET');
        $answers = array('3', '2', '2', '1');

        $request = $this->BackgroundCheck->answers($ticket, $answers);
        $this->assertEquals(200, $request->http_status);

    }

    public function testFacematch(): void
    {
        $frente  = getenv('FRENTE');
        $selfie  = getenv('SELFIE');

        $request = $this->BackgroundCheck->facematch($frente, $selfie);

        $arrayFace = (array) $request->response;

        $this->assertArrayHasKey('createdAt', $arrayFace);
        $this->assertArrayHasKey('updatedAt', $arrayFace);
        $this->assertArrayHasKey('match', $arrayFace);
        $this->assertArrayHasKey('document', $arrayFace);
        $this->assertArrayHasKey('selfie', $arrayFace);
        $this->assertArrayHasKey('BIRTHDATE', $arrayFace);
        $this->assertArrayHasKey('CPF', $arrayFace);
        $this->assertArrayHasKey('DOCTYPE', $arrayFace);
        $this->assertArrayHasKey('EXPEDITIONDATE', $arrayFace);
        $this->assertArrayHasKey('FATHERNAME', $arrayFace);
        $this->assertArrayHasKey('MOTHERNAME', $arrayFace);
        $this->assertArrayHasKey('NAME', $arrayFace);
        $this->assertEquals(200, $request->http_status);
        $this->assertEquals('2019-07-29', date("Y-m-d", strtotime($arrayFace['createdAt'])));
        $this->assertEquals('2019-07-29', date("Y-m-d", strtotime($arrayFace['updatedAt'])));
        $this->assertEquals(true, $arrayFace['match']);
        $this->assertEquals($selfie, $arrayFace['selfie']);
        $this->assertEquals($frente, $arrayFace['document']);
        $this->assertEquals('21/07/1974', $arrayFace['BIRTHDATE']);
        $this->assertNotEmpty($arrayFace['CPF']);
        $this->assertEquals('RG', $arrayFace['DOCTYPE']);
        $this->assertEquals('08/07/2002', $arrayFace['EXPEDITIONDATE']);
        $this->assertNotEmpty($arrayFace['FATHERNAME']);
        $this->assertNotEmpty($arrayFace['MOTHERNAME']);
        $this->assertNotEmpty($arrayFace['NAME']);
    }
}
