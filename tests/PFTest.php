<?php
namespace Fincore\Test;

final class PFTest extends \PHPUnit\Framework\TestCase
{
    private $PF;
    protected function setup(): void
    {
        $this->PF  = new \Fincore\PF();
        $this->Cpf = getenv('CPF');

    }

    public function testAds(): void
    {
        $request = $this->PF->ads($this->Cpf);
        $this->assertEquals(200, $request->http_status);
    }

    public function testBasic(): void
    {
        $request = $this->PF->basic($this->Cpf);

        $this->assertEquals(200, $request->http_status);
        $this->Cpf = preg_replace("/[^0-9]/", "", $this->Cpf);

        $this->assertEquals(
            $this->Cpf,
            preg_replace("/[^0-9]/",
                "",
                $request->response->document
            )
        );

        $this->assertNotEmpty($request->response->TaxIdCountry);
        $this->assertNotEmpty($request->response->TaxIdCountry);
        $this->assertNotEmpty($request->response->Gender);
        $this->assertNotEmpty($request->response->Age);
        $this->assertNotEmpty($request->response->ZodiacSign);
        $this->assertNotEmpty($request->response->ChineseSign);
        $this->assertNotEmpty($request->response->TaxIdOrigin);
        $this->assertNotEmpty($request->response->BirthCountry);
        $this->assertNotEmpty($request->response->BirthDate);
    }

    public function testMemberships(): void
    {
        $request = $this->PF->memberships($this->Cpf);

        if (sizeof($request->response->Memberships)) {
            foreach ($request->response->Memberships as $application) {

                $arrayMemberships = (array) $application;

                $this->assertArrayHasKey('OrganizationName', $arrayMemberships);
                $this->assertArrayHasKey('OrganizationCountry', $arrayMemberships);
                $this->assertArrayHasKey('OrganizationType', $arrayMemberships);
                $this->assertArrayHasKey('OrganizationChapter', $arrayMemberships);
                $this->assertArrayHasKey('RegistrationId', $arrayMemberships);
                $this->assertArrayHasKey('Category', $arrayMemberships);
                $this->assertArrayHasKey('Status', $arrayMemberships);

                $this->assertNOtEmpty($application->OrganizationName);
                $this->assertNOtEmpty($application->OrganizationCountry);
                $this->assertNOtEmpty($application->OrganizationType);
                $this->assertNOtEmpty($application->OrganizationChapter);
                $this->assertNOtEmpty($application->Category);

                $this->assertEquals('NORMAL', $application->Status);
            }

            $this->assertEquals(
                $this->Cpf,
                preg_replace("/[^0-9]/",
                    "",
                    $request->response->document
                ));
        }

    }

    public function testPublicProfessions(): void
    {
        $request = $this->PF->publicProfessions($this->Cpf);

        $this->Cpf = preg_replace("/[^0-9]/", "", $this->Cpf);

        $this->assertEquals($this->Cpf, $request->response->document);
        $this->assertEquals(200, $request->http_status);
    }

    public function testProfessions(): void
    {
        $request = $this->PF->professions($this->Cpf);

        $this->assertEquals(200, $request->http_status);
        $this->Cpf = preg_replace("/[^0-9]/", "", $this->Cpf);

        $this->assertEquals(
            $this->Cpf,
            preg_replace(
                "/[^0-9]/",
                "",
                $request->response->document
            )
        );
    }

    public function testUniversityStudents(): void
    {
        $request = $this->PF->universityStudents($this->Cpf);

        $this->assertEquals(200, $request->http_status);
        $this->Cpf = preg_replace("/[^0-9]/", "", $this->Cpf);

        $this->assertEquals(
            $this->Cpf,
            preg_replace(
                "/[^0-9]/",
                "",
                $request->response->document
            )
        );

        $this->assertNotEmpty($request->response->ScholarshipLevel);
    }

    public function testDomains(): void
    {
        $request = $this->PF->domains($this->Cpf);

        $this->assertEquals(200, $request->http_status);

        if (sizeof($request->response)) {
            foreach ($request->response as $application) {
                //loop
                $Domains = (array) $application;

                $this->assertArrayHasKey('HostName', $Domains);
                $this->assertArrayHasKey('DomainName', $Domains);
                $this->assertArrayHasKey('DomainClass', $Domains);
                $this->assertArrayHasKey('ServerTechnology', $Domains);
                $this->assertArrayHasKey('Framework', $Domains);
                $this->assertArrayHasKey('PageCountRange', $Domains);
                $this->assertArrayHasKey('IspCountry', $Domains);
                $this->assertArrayHasKey('IspRegion', $Domains);
                $this->assertArrayHasKey('IspCity', $Domains);
                $this->assertArrayHasKey('AnalyticsServices', $Domains);
                $this->assertArrayHasKey('IsActive', $Domains);
                $this->assertArrayHasKey('HasSsl', $Domains);
                $this->assertArrayHasKey('RegistrationDate', $Domains);
                $this->assertArrayHasKey('ExpirationDate', $Domains);
                $this->assertArrayHasKey('document', $Domains);

                //$this->assertNotEmpty($Domains['HostName']);
                $this->assertNotEmpty($Domains['DomainName']);
                $this->assertNotEmpty($Domains['FinalDomainName']);
                //$this->assertNotEmpty($Domains['ServerTechnology']);
                $this->assertNotEmpty($Domains['Framework']);
                $this->assertNotEmpty($Domains['DomainClass']);
                $this->assertNotEmpty($Domains['PageCountRange']);
                //$this->assertNotEmpty($Domains['IspCountry']);
                //$this->assertNotEmpty($Domains['IspRegion']);
                //$this->assertNotEmpty($Domains['IspCity']);
                //$this->assertNotEmpty($Domains['AnalyticsServices']);
                //$this->assertNotEmpty($Domains['RegistrationDate']);
                //$this->assertNotEmpty($Domains['ExpirationDate']);
                //$this->assertNotEmpty($Domains['IsActive']);
                //$this->assertNotEmpty($Domains['HasSsl']);

                $this->Cpf = preg_replace("/[^0-9]/", "", $this->Cpf);

                $this->assertEquals(
                    $this->Cpf,
                    preg_replace("/[^0-9]/",
                        "",
                        $Domains['document']
                    )
                );
            }
        }
    }

    public function testEmails(): void
    {
        $request = $this->PF->email($this->Cpf);

        // $this->assertCount(3, $request->response);
        // esta embaixo
        if (sizeof($request->response)) {
            foreach ($request->response as $application) {
                $Email = (array) $application;
                // loop
                $this->assertArrayHasKey('EmailAddress', $Email);
                $this->assertArrayHasKey('Domain', $Email);
                $this->assertArrayHasKey('UserName', $Email);
                $this->assertArrayHasKey('Type', $Email);
                $this->assertArrayHasKey('IsRecent', $Email);
                $this->assertArrayHasKey('ValidationStatus', $Email);
                $this->assertArrayHasKey('FirstPassageDate', $Email);
                $this->assertArrayHasKey('document', $Email);

                $this->assertNotEmpty($Email['EmailAddress']);
                $this->assertNotEmpty($Email['Domain']);
                $this->assertNotEmpty($Email['UserName']);
                $this->assertNotEmpty($Email['Type']);
                $this->assertNotEmpty($Email['FirstPassageDate']);

                $this->assertEquals(false, $Email['IsRecent']);
                $this->assertEquals('VALID', $Email['ValidationStatus']);
                $this->assertEquals(200, $request->http_status);

                $this->Cpf = preg_replace("/[^0-9]/", "", $this->Cpf);

                $this->assertEquals(
                    $this->Cpf,
                    preg_replace("/[^0-9]/",
                        "", $Email['document']
                    )
                );
            }
        }
    }
    /*public function testvehicles($cpf): void
{
$request = $this->PF->vehicles($cpf);
$this->assertEquals(200, $request->http_status);
}*/

}
