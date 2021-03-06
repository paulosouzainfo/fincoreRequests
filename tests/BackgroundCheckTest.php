<?php
namespace Fincore\Test;

final class BackgroundCheckTest extends \PHPUnit\Framework\TestCase
{
    private $BackgroundCheck;

    protected function setup(): void
    {
        $this->BackgroundCheck = new \Fincore\BackgroundCheck();
    }

    public function testDocuments(): void
    {
        $imageURL = getenv('DOCUMENTO');
        $type     = getenv('TIPO');
        $side     = getenv('SIDE');

        $request = $this->BackgroundCheck->documents($imageURL, $type, $side);
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
        $this->assertEquals($imageURL, $arrayDoc['document']);

        $this->assertNotEmpty($arrayDoc['createdAt']);
        $this->assertNotEmpty($arrayDoc['updatedAt']);
        $this->assertNotEmpty($arrayDoc['type']);
        $this->assertNotEmpty($arrayDoc['side']);
        $this->assertNotEmpty($arrayDoc['BIRTHDATE']);
        $this->assertNotEmpty($arrayDoc['CPF']);
        $this->assertNotEmpty($arrayDoc['DOCTYPE']);
        $this->assertNotEmpty($arrayDoc['EXPEDITIONDATE']);
        $this->assertNotEmpty($arrayDoc['FATHERNAME']);
        $this->assertNotEmpty($arrayDoc['MOTHERNAME']);
        $this->assertNotEmpty($arrayDoc['NAME']);
    }

    public function testQuestion(): void
    {
        $document = preg_replace("/[^0-9]/", "", getenv('CPF'));

        $request = $this->BackgroundCheck->question($document);

        putenv("TICKET={$request->response->TicketId}");

        $this->assertNotEmpty($request->response->TicketId);
        $this->assertCount(4, $request->response->Questions);

        $this->assertEquals($document, $request->response->document);
        $this->assertEquals(200, $request->http_status);
    }

    public function testAnswers(): void
    {
        $ticket  = getenv('TICKET');
        $answers = [rand(0, 3), rand(0, 3), rand(0, 3), rand(0, 3)];

        $request = $this->BackgroundCheck->answers($ticket, $answers);
        $this->assertEquals(200, $request->http_status);
    }

    public function testFacematch(): void
    {
        $frente = getenv('DOCUMENTO');
        $selfie = getenv('SELFIE');

        $request = $this->BackgroundCheck->facematch($frente, $selfie);
        $arrayFace = (array)$request->response;

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

        $this->assertInternalType('bool', $arrayFace['match']);

        $this->assertEquals(200, $request->http_status);
        $this->assertEquals($selfie, $arrayFace['selfie']);
        $this->assertEquals($frente, $arrayFace['document']);

        $this->assertNotEmpty($arrayFace['createdAt']);
        $this->assertNotEmpty($arrayFace['updatedAt']);
        $this->assertNotEmpty($arrayFace['BIRTHDATE']);
        $this->assertNotEmpty($arrayFace['CPF']);
        $this->assertNotEmpty($arrayFace['DOCTYPE']);
        $this->assertNotEmpty($arrayFace['EXPEDITIONDATE']);
        $this->assertNotEmpty($arrayFace['FATHERNAME']);
        $this->assertNotEmpty($arrayFace['MOTHERNAME']);
        $this->assertNotEmpty($arrayFace['NAME']);
    }
}
