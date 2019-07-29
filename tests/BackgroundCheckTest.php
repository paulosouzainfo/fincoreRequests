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
        $imageURL       = getenv('FRENTE');
        $type           = getenv('TIPO');
        $side           = getenv('SIDE');
        $request        = $this->BackgroundCheck->documents($imageURL, $type, $side);
        $arrayDocuments = (array) $request->response;
        $this->assertArrayHasKey('createdAt', $arrayDocuments);
        $this->assertArrayHasKey('updatedAt', $arrayDocuments);
        $this->assertArrayHasKey('document', $arrayDocuments);
        $this->assertArrayHasKey('type', $arrayDocuments);
        $this->assertArrayHasKey('side', $arrayDocuments);
        $this->assertArrayHasKey('BIRTHDATE', $arrayDocuments);
        $this->assertArrayHasKey('CPF', $arrayDocuments);
        $this->assertArrayHasKey('DOCTYPE', $arrayDocuments);
        $this->assertArrayHasKey('EXPEDITIONDATE', $arrayDocuments);
        $this->assertArrayHasKey('FATHERNAME', $arrayDocuments);
        $this->assertArrayHasKey('MOTHERNAME', $arrayDocuments);
        $this->assertArrayHasKey('NAME', $arrayDocuments);
        $this->assertEquals(200, $request->http_status);
        $this->assertEquals('2019-07-26', date("Y-m-d", strtotime($arrayDocuments['createdAt'])));
        $this->assertEquals('2019-07-26', date("Y-m-d", strtotime($arrayDocuments['updatedAt'])));
        $this->assertEquals($imageURL, $arrayDocuments['document']);
        $this->assertEquals($type, $arrayDocuments['type']);
        $this->assertEquals($side, $arrayDocuments['side']);
        $this->assertEquals('21/07/1974', $arrayDocuments['BIRTHDATE']);
        $this->assertNotEmpty($arrayDocuments['CPF']);
        $this->assertEquals('RG', $arrayDocuments['DOCTYPE']);
        $this->assertEquals('08/07/2002', $arrayDocuments['EXPEDITIONDATE']);
        $this->assertNotEmpty($arrayDocuments['FATHERNAME']);
        $this->assertNotEmpty($arrayDocuments['MOTHERNAME']);
        $this->assertNotEmpty($arrayDocuments['NAME']);

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
        $frente         = getenv('FRENTE');
        $selfie         = getenv('SELFIE');
        $request        = $this->BackgroundCheck->facematch($frente, $selfie);
        $arrayFacematch = (array) $request->response;
        $this->assertArrayHasKey('createdAt', $arrayFacematch);
        $this->assertArrayHasKey('updatedAt', $arrayFacematch);
        $this->assertArrayHasKey('match', $arrayFacematch);
        $this->assertArrayHasKey('document', $arrayFacematch);
        $this->assertArrayHasKey('selfie', $arrayFacematch);
        $this->assertArrayHasKey('BIRTHDATE', $arrayFacematch);
        $this->assertArrayHasKey('CPF', $arrayFacematch);
        $this->assertArrayHasKey('DOCTYPE', $arrayFacematch);
        $this->assertArrayHasKey('EXPEDITIONDATE', $arrayFacematch);
        $this->assertArrayHasKey('FATHERNAME', $arrayFacematch);
        $this->assertArrayHasKey('MOTHERNAME', $arrayFacematch);
        $this->assertArrayHasKey('NAME', $arrayFacematch);
        $this->assertEquals(200, $request->http_status);
        $this->assertEquals('2019-07-29', date("Y-m-d", strtotime($arrayFacematch['createdAt'])));
        $this->assertEquals('2019-07-29', date("Y-m-d", strtotime($arrayFacematch['updatedAt'])));
        $this->assertEquals(true, $arrayFacematch['match']);
        $this->assertEquals($selfie, $arrayFacematch['selfie']);
        $this->assertEquals($frente, $arrayFacematch['document']);
        $this->assertEquals('21/07/1974', $arrayFacematch['BIRTHDATE']);
        $this->assertNotEmpty($arrayFacematch['CPF']);
        $this->assertEquals('RG', $arrayFacematch['DOCTYPE']);
        $this->assertEquals('08/07/2002', $arrayFacematch['EXPEDITIONDATE']);
        $this->assertNotEmpty($arrayFacematch['FATHERNAME']);
        $this->assertNotEmpty($arrayFacematch['MOTHERNAME']);
        $this->assertNotEmpty($arrayFacematch['NAME']);

    }
}
