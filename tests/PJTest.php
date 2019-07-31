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

    public function testads($cnpj): void
    {
        $request = $this->PJ->ads($cnpj);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider Cnpj
     */
    public function testbasic($cnpj): void
    {
        $request = $this->PJ->basic($cnpj);

        $this->assertEquals(200, $request->http_status);

        $arrayBasic = (array) $request->response;
        
        $this->assertArrayHasKey('TaxIdCountry', $arrayBasic);
        $this->assertArrayHasKey('OfficialName', $arrayBasic);
        $this->assertArrayHasKey('FoundedDate', $arrayBasic);
        $this->assertArrayHasKey('Age', $arrayBasic);
        $this->assertArrayHasKey('TaxIdStatus', $arrayBasic);
        $this->assertArrayHasKey('TaxRegime', $arrayBasic);
        $this->assertArrayHasKey('Activities', $arrayBasic);
        $this->assertArrayHasKey('LegalNature', $arrayBasic);
        $this->assertEquals('Brazil', $arrayBasic['TaxIdCountry']);
        $this->assertNotEmpty($arrayBasic['OfficialName']);
        $this->assertEquals('1969-10-29', date("Y-m-d", strtotime($arrayBasic['FoundedDate'])));
        $this->assertEquals(49, $arrayBasic['Age']);
        $this->assertEquals('ATIVA', $arrayBasic['TaxIdStatus']);
        $this->assertEquals('S.A.', $arrayBasic['TaxRegime']);
        $this->assertEquals('BANCOS COMERCIAIS', $arrayBasic['Activities'][0]->Activity);
        $this->assertEquals('SOCIEDADE ANONIMA FECHADA', $arrayBasic['LegalNature']->Activity);
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
        $this->assertEquals($cnpj, preg_replace("/[^0-9]/", "", $arrayBasic['document']));
    }
    /**
     * @dataProvider Cnpj
     */
    public function testdomains($cnpj): void
    {
        $request = $this->PJ->domains($cnpj);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider Cnpj
     */
    public function testemails($cnpj): void
    {
        $request = $this->PJ->emails($cnpj);

        $this->assertEquals(200, $request->http_status);
        $this->assertCount(94, $request->response);
        $arrayEmails = (array) $request->response[0];
        $this->assertArrayHasKey('EmailAddress', $arrayEmails);
        $this->assertArrayHasKey('Domain', $arrayEmails);
        $this->assertArrayHasKey('UserName', $arrayEmails);
        $this->assertArrayHasKey('Type', $arrayEmails);
        $this->assertArrayHasKey('IsRecent', $arrayEmails);
        $this->assertArrayHasKey('ValidationStatus', $arrayEmails);
        $this->assertArrayHasKey('FirstPassageDate', $arrayEmails);
        $this->assertArrayHasKey('document', $arrayEmails);
        $this->assertNotEmpty($arrayEmails['EmailAddress']);
        $this->assertNotEmpty($arrayEmails['Domain']);
        $this->assertNotEmpty($arrayEmails['UserName']);
        $this->assertEquals('corporate', $arrayEmails['Type']);
        $this->assertEquals(false, $arrayEmails['IsRecent']);
        $this->assertEquals('2014-05-28', date("Y-m-d", strtotime($arrayEmails['FirstPassageDate'])));
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
        $this->assertEquals($cnpj, preg_replace("/[^0-9]/", "", $arrayEmails['document']));
    }
    /**
     * @dataProvider Cnpj
     */
    public function testmediaExposure($cnpj): void
    {
        $request = $this->PJ->mediaExposure($cnpj);

        $this->assertEquals(200, $request->http_status);

        $arrayExposure = (array) $request->response;
        
        $this->assertArrayHasKey('MediaExposureLevel', $arrayExposure);
        $this->assertArrayHasKey('CelebrityLevel', $arrayExposure);
        $this->assertArrayHasKey('UnpopularityLevel', $arrayExposure);
        $this->assertEquals('H', $arrayExposure['MediaExposureLevel']);
        $this->assertEquals('H', $arrayExposure['CelebrityLevel']);
        $this->assertEquals('H', $arrayExposure['UnpopularityLevel']);
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
        $this->assertEquals($cnpj, preg_replace("/[^0-9]/", "", $arrayExposure['document']));
    }
    /**
     * @dataProvider Cnpj
     */
    public function testactivityIndicators($cnpj): void
    {
        $request         = $this->PJ->activityIndicators($cnpj);
        
        $arrayIndicators = (array) $request->response;

        $this->assertArrayHasKey('IncomeRange', $arrayIndicators);
        $this->assertArrayHasKey('ActivityLevel', $arrayIndicators);
        $this->assertArrayHasKey('HasActivity', $arrayIndicators);
        $this->assertArrayHasKey('HasRecentAddress', $arrayIndicators);
        $this->assertArrayHasKey('HasRecentPhone', $arrayIndicators);
        $this->assertArrayHasKey('HasRecentEmail', $arrayIndicators);
        $this->assertArrayHasKey('HasRecentPassages', $arrayIndicators);
        $this->assertArrayHasKey('HasActiveDomain', $arrayIndicators);
        $this->assertArrayHasKey('HasActiveSSL', $arrayIndicators);
        $this->assertArrayHasKey('HasCorporateEmail', $arrayIndicators);
        $this->assertArrayHasKey('NumberOfBranches', $arrayIndicators);
        $this->assertEquals('ACIMA DE 10MM ATE 25MM', $arrayIndicators['IncomeRange']);
        $this->assertEquals(0.33, $arrayIndicators['ActivityLevel']);
        $this->assertEquals(true, $arrayIndicators['HasActivity']);
        $this->assertEquals(false, $arrayIndicators['HasRecentAddress']);
        $this->assertEquals(false, $arrayIndicators['HasRecentPhone']);
        $this->assertEquals(true, $arrayIndicators['HasRecentEmail']);
        $this->assertEquals(true, $arrayIndicators['HasRecentPassages']);
        $this->assertEquals(true, $arrayIndicators['HasActiveDomain']);
        $this->assertEquals(true, $arrayIndicators['HasActiveSSL']);
        $this->assertEquals(false, $arrayIndicators['HasCorporateEmail']);
        $this->assertEquals(1, $arrayIndicators['NumberOfBranches']);
        $this->assertEquals(200, $request->http_status);

    }
    /**
     * @dataProvider Cnpj
     */
    public function testrelationships($cnpj): void
    {
        $request            = $this->PJ->relationships($cnpj);

        $arrayrelationships = (array) $request->response;
        
        $this->assertCount(45, $arrayrelationships['Relationships']);
        $listrelationships = (array) $arrayrelationships['Relationships'][0];
        $this->assertArrayHasKey('RelatedEntityTaxIdNumber', $listrelationships);
        $this->assertArrayHasKey('RelatedEntityTaxIdType', $listrelationships);
        $this->assertArrayHasKey('RelatedEntityTaxIdCountry', $listrelationships);
        $this->assertArrayHasKey('RelatedEntityTaxIdType', $listrelationships);
        $this->assertArrayHasKey('RelatedEntityName', $listrelationships);
        $this->assertArrayHasKey('RelationshipType', $listrelationships);
        $this->assertArrayHasKey('RelationshipName', $listrelationships);
        $this->assertArrayHasKey('RelationshipLevel', $listrelationships);
        $this->assertArrayHasKey('RelationshipStartDate', $listrelationships);
        $this->assertEquals('CPF', $listrelationships['RelatedEntityTaxIdType']);
        $this->assertEquals('Brazil', $listrelationships['RelatedEntityTaxIdCountry']);
        $this->assertEquals('QSA', $listrelationships['RelationshipType']);
        $this->assertEquals('DIRETOR', $listrelationships['RelationshipName']);
        $this->assertEquals('Direct', $listrelationships['RelationshipLevel']);
        $this->assertEquals('1969-10-29', date("Y-m-d", strtotime($listrelationships['RelationshipStartDate'])));
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider Cnpj
     */
    public function testphones($cnpj): void
    {
        $request = $this->PJ->phones($cnpj);

        $this->assertCount(32, $request->response);

        $arrayphones = (array) $request->response[0];
        
        $this->assertArrayHasKey('Number', $arrayphones);
        $this->assertArrayHasKey('AreaCode', $arrayphones);
        $this->assertArrayHasKey('CountryCode', $arrayphones);
        $this->assertArrayHasKey('Type', $arrayphones);
        $this->assertArrayHasKey('IsRecent', $arrayphones);
        $this->assertArrayHasKey('FirstPassageDate', $arrayphones);
        $this->assertArrayHasKey('IsActive', $arrayphones);
        $this->assertArrayHasKey('IsInDoNotCallList', $arrayphones);
        $this->assertEquals('21', $arrayphones['AreaCode']);
        $this->assertEquals('55', $arrayphones['CountryCode']);
        $this->assertEquals('WORK', $arrayphones['Type']);
        $this->assertEquals(false, $arrayphones['IsActive']);
        $this->assertEquals(false, $arrayphones['IsInDoNotCallList']);
        $this->assertEquals('2005-03-11', date("Y-m-d", strtotime($arrayphones['FirstPassageDate'])));
        $this->assertEquals(200, $request->http_status);
    }
}
