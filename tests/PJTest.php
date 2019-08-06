<?php
namespace Fincore\Test;

final class PJTest extends \PHPUnit\Framework\TestCase
{
    private $PJ;

    protected function setup(): void
    {
        $this->PJ   = new \Fincore\PJ();
        $this->Cnpj = getenv('CNPJ');
    }

    public function testads(): void
    {
        $request = $this->PJ->ads($this->Cnpj);
        $this->assertEquals(200, $request->http_status);
    }

    public function testbasic(): void
    {
        $request = $this->PJ->basic($this->Cnpj);

        if (!empty($request->response)) {

            $arrayBasic = (array) $request->response;

            $this->assertArrayHasKey('TaxIdCountry', $arrayBasic);
            $this->assertArrayHasKey('OfficialName', $arrayBasic);
            $this->assertArrayHasKey('FoundedDate', $arrayBasic);
            $this->assertArrayHasKey('Age', $arrayBasic);
            $this->assertArrayHasKey('TaxIdStatus', $arrayBasic);
            $this->assertArrayHasKey('TaxRegime', $arrayBasic);
            $this->assertArrayHasKey('Activities', $arrayBasic);
            $this->assertArrayHasKey('LegalNature', $arrayBasic);

            $this->assertNotEmpty($arrayBasic['OfficialName']);
            $this->assertNotEmpty($arrayBasic['FoundedDate']);
            $this->assertNOtEmpty($arrayBasic['Age']);
            $this->assertNOtEmpty($arrayBasic['TaxIdStatus']);
            $this->assertNOtEmpty($arrayBasic['TaxRegime']);
            $this->assertNOtEmpty($arrayBasic['Activities'][0]->Activity);
            $this->assertNOtEmpty($arrayBasic['LegalNature']->Activity);
            $this->assertNOtEmpty($arrayBasic['TaxIdCountry']);

            $this->assertEquals(200, $request->http_status);

            $this->Cnpj = preg_replace("/[^0-9]/", "", $this->Cnpj);

            $this->assertEquals(
                $this->Cnpj,
                preg_replace("/[^0-9]/",
                    "",
                    $arrayBasic['document']
                )
            );
        }
    }

    public function testdomains(): void
    {
        $request = $this->PJ->domains($this->Cnpj);
        $this->assertEquals(200, $request->http_status);
    }

    public function testemails(): void
    {
        $request = $this->PJ->emails($this->Cnpj);

        if (sizeof($request->response)) {
            foreach ($request->response as $application) {

                $arrayEmails = (array) $application;
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

                $this->assertNotEmpty($arrayEmails['Type']);
                $this->assertInternalType('bool', $arrayEmails['IsRecent']);
                //$this->assertNotEmpty($arrayEmails['IsRecent']);
                $this->assertNotEmpty($arrayEmails['FirstPassageDate']);
            }
        }

        $this->assertEquals(200, $request->http_status);

        $this->Cnpj = preg_replace("/[^0-9]/", "", $this->Cnpj);

        $this->assertEquals(
            $this->Cnpj,
            preg_replace("/[^0-9]/",
                "",
                $arrayEmails['document']
            )
        );
    }

    public function testmediaExposure(): void
    {
        $request = $this->PJ->mediaExposure($this->Cnpj);

        $arrayExposure = (array) $request->response;

        $this->assertArrayHasKey('MediaExposureLevel', $arrayExposure);
        $this->assertArrayHasKey('CelebrityLevel', $arrayExposure);
        $this->assertArrayHasKey('UnpopularityLevel', $arrayExposure);

        $this->assertNotEmpty($arrayExposure['MediaExposureLevel']);
        $this->assertNotEmpty($arrayExposure['CelebrityLevel']);
        $this->assertNotEmpty($arrayExposure['UnpopularityLevel']);

        $this->Cnpj = preg_replace("/[^0-9]/", "", $this->Cnpj);

        $this->assertEquals(
            $this->Cnpj,
            preg_replace("/[^0-9]/",
                "",
                $arrayExposure['document']
            )
        );

        $this->assertEquals(200, $request->http_status);
    }

    public function testactivityIndicators(): void
    {
        $request = $this->PJ->activityIndicators($this->Cnpj);

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

        $this->assertNotEmpty($arrayIndicators['IncomeRange']);
        $this->assertNotEmpty($arrayIndicators['ActivityLevel']);
        $this->assertNotEmpty($arrayIndicators['HasActivity']);
        //$this->assertNotEmpty($arrayIndicators['HasRecentAddress']);
        //$this->assertNotEmpty($arrayIndicators['HasRecentPhone']);
        $this->assertNotEmpty($arrayIndicators['HasRecentEmail']);
        $this->assertNotEmpty($arrayIndicators['HasRecentPassages']);
        $this->assertNotEmpty($arrayIndicators['HasActiveDomain']);
        $this->assertNotEmpty($arrayIndicators['HasActiveSSL']);
        //$this->assertNotEmpty($arrayIndicators['HasCorporateEmail']);
        $this->assertNotEmpty($arrayIndicators['NumberOfBranches']);
        $this->assertNotEmpty($request->http_status);

    }

    public function testrelationships(): void
    {
        $request = $this->PJ->relationships($this->Cnpj);

        if (sizeof($request->response->Relationships)) {

            foreach ($request->response->Relationships as $application) {

                $listrelationships = (array) $application;

                $this->assertArrayHasKey('RelatedEntityTaxIdNumber', $listrelationships);
                $this->assertArrayHasKey('RelatedEntityTaxIdType', $listrelationships);
                $this->assertArrayHasKey('RelatedEntityTaxIdCountry', $listrelationships);
                $this->assertArrayHasKey('RelatedEntityTaxIdType', $listrelationships);
                $this->assertArrayHasKey('RelatedEntityName', $listrelationships);
                $this->assertArrayHasKey('RelationshipType', $listrelationships);
                $this->assertArrayHasKey('RelationshipName', $listrelationships);
                $this->assertArrayHasKey('RelationshipLevel', $listrelationships);
                $this->assertArrayHasKey('RelationshipStartDate', $listrelationships);

                $this->assertNotEmpty($listrelationships['RelatedEntityTaxIdType']);
                $this->assertNotEmpty($listrelationships['RelatedEntityTaxIdCountry']);
                $this->assertNotEmpty($listrelationships['RelationshipType']);
                //$this->assertNotEmpty($listrelationships['RelationshipName']);
                //$this->assertNotEmpty($listrelationships['RelationshipLevel']);
                // $this->assertNotEmpty($listrelationships['RelationshipStarDate']);
            }

            $this->assertEquals(200, $request->http_status);
        }
    }

    public function testphones(): void
    {
        $request = $this->PJ->phones($this->Cnpj);

        if (sizeof($request->response)) {

            foreach ($request->response as $application) {

                $arrayphones = (array) $application;

                $this->assertArrayHasKey('Number', $arrayphones);
                $this->assertArrayHasKey('AreaCode', $arrayphones);
                $this->assertArrayHasKey('CountryCode', $arrayphones);
                $this->assertArrayHasKey('Type', $arrayphones);
                $this->assertArrayHasKey('IsRecent', $arrayphones);
                $this->assertArrayHasKey('FirstPassageDate', $arrayphones);
                $this->assertArrayHasKey('IsActive', $arrayphones);
                $this->assertArrayHasKey('IsInDoNotCallList', $arrayphones);

                $this->assertNotEmpty($arrayphones['AreaCode']);
                $this->assertNotEmpty($arrayphones['CountryCode']);
                $this->assertNotEmpty($arrayphones['Type']);

                $this->assertInternalType('bool', $arrayphones['IsActive']);
                $this->assertInternalType('bool', $arrayphones['IsActive']);
              
                $this->assertNotEmpty($arrayphones['FirstPassageDate']);

            }
        }
        $this->assertEquals(200, $request->http_status);
    }
}
