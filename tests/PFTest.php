<?php
namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();
final class PFTest extends \PHPUnit\Framework\TestCase
{
    private $PF;
    protected function setup(): void
    {
        $this->PF = new \Fincore\PF();
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
    public function testAds($cpf): void
    {
        $request = $this->PF->ads($cpf);

        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    public function testBasic($cpf): void
    {
        $request = $this->PF->basic($cpf);
        $this->assertEquals(200, $request->http_status);
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $this->assertEquals($cpf, preg_replace("/[^0-9]/", "", $request->response->document));
        $this->assertEquals('BRAZIL', $request->response->TaxIdCountry);
        $this->assertEquals('M', $request->response->Gender);
        $this->assertEquals('33', $request->response->Age);
        $this->assertEquals('PEIXES', $request->response->ZodiacSign);
        $this->assertEquals('Tiger', $request->response->ChineseSign);
        $this->assertEquals('RECEITA FEDERAL', $request->response->TaxIdOrigin);
        $this->assertEquals('BRASILEIRA', $request->response->BirthCountry);
        $this->assertEquals('1986-03-05', date("Y-m-d", strtotime($request->response->BirthDate)));

    }
    /**
     * @dataProvider CPF
     */
    public function testMemberships($cpf): void
    {
        $request = $this->PF->memberships($cpf);
        $this->assertEquals(200, $request->http_status);
        $this->assertCount(1, $request->response->Memberships);

        $arrayMemberships = (array) $request->response->Memberships[0];

        $this->assertArrayHasKey('OrganizationName', $arrayMemberships);
        $this->assertArrayHasKey('OrganizationCountry', $arrayMemberships);
        $this->assertArrayHasKey('OrganizationType', $arrayMemberships);
        $this->assertArrayHasKey('OrganizationChapter', $arrayMemberships);
        $this->assertArrayHasKey('RegistrationId', $arrayMemberships);
        $this->assertArrayHasKey('Category', $arrayMemberships);
        $this->assertArrayHasKey('Status', $arrayMemberships);

        $this->assertEquals('CREARJ', $request->response->Memberships[0]->OrganizationName);
        $this->assertEquals('BRAZIL', $request->response->Memberships[0]->OrganizationCountry);
        $this->assertEquals('CLASS ASSOCIATION', $request->response->Memberships[0]->OrganizationType);
        $this->assertEquals('RJ', $request->response->Memberships[0]->OrganizationChapter);
        $this->assertEquals('ENGENHEIRO DE PETROLEO', $request->response->Memberships[0]->Category);
        $this->assertEquals('NORMAL', $request->response->Memberships[0]->Status);
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $this->assertEquals($cpf, $this->assertEquals($cpf, preg_replace("/[^0-9]/", "", $request->response->document));
        }
        /**
         * @dataProvider CPF
         */
        public function testPublicProfessions($cpf): void
    {
            $request = $this->PF->publicProfessions($cpf);
            $this->assertEquals(200, $request->http_status);
            $cpf = preg_replace("/[^0-9]/", "", $cpf);
            $this->assertEquals($cpf, $request->response->document);
        }
        /**
         * @dataProvider CPF
         */
        public function testProfessions($cpf): void
    {
            $request = $this->PF->professions($cpf);
            $this->assertEquals(200, $request->http_status);
            $cpf = preg_replace("/[^0-9]/", "", $cpf);
            $this->assertEquals($cpf, preg_replace("/[^0-9]/", "", $request->response->document));
        }
        /**
         * @dataProvider CPF
         */
        public function testUniversityStudents($cpf): void
    {
            $request = $this->PF->universityStudents($cpf);
            $this->assertEquals(200, $request->http_status);
            $cpf = preg_replace("/[^0-9]/", "", $cpf);
            $this->assertEquals($cpf, preg_replace("/[^0-9]/", "", $request->response->document));
            $this->assertNotEmpty($request->response->ScholarshipLevel);

        }
        /**
         * @dataProvider CPF
         */
        public function testDomains($cpf): void
    {
            $request = $this->PF->domains($cpf);
            $this->assertEquals(200, $request->http_status);
            $Domains = (array) $request->response[0];
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
            $this->assertNotEmpty($Domains['HostName']);
            $this->assertNotEmpty($Domains['DomainName']);
            $this->assertNotEmpty($Domains['FinalDomainName']);
            $this->assertEquals('nginx/1.14.0', $Domains['ServerTechnology']);
            $this->assertEquals('Wordpress - www.wordpress.com', $Domains['Framework']);
            $this->assertEquals('ECOMMERCE', $Domains['DomainClass']);
            $this->assertEquals('50-100', $Domains['PageCountRange']);
            $this->assertEquals('United States', $Domains['IspCountry']);
            $this->assertEquals('Texas', $Domains['IspRegion']);
            $this->assertEquals('Houston', $Domains['IspCity']);
            $this->assertEquals('Google Analytics', $Domains['AnalyticsServices']);
            $this->assertEquals(true, $Domains['IsActive']);
            $this->assertEquals(true, $Domains['HasSsl']);
            $this->assertNotEmpty($Domains['RegistrationDate']);
            $this->assertNotEmpty($Domains['ExpirationDate']);
            $cpf = preg_replace("/[^0-9]/", "", $cpf);
            $this->assertEquals($cpf, preg_replace("/[^0-9]/", "", $Domains['document']));

        }
        /**
         * @dataProvider CPF
         */
        public function testEmails($cpf): void
    {
            $request = $this->PF->email($cpf);
            $this->assertCount(3, $request->response);
            $this->assertEquals(200, $request->http_status);
            $Email = (array) $request->response[0];
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
            $this->assertEquals('corporate', $Email['Type']);
            $this->assertEquals(false, $Email['IsRecent']);
            $this->assertEquals('VALID', $Email['ValidationStatus']);
            $cpf = preg_replace("/[^0-9]/", "", $cpf);
            $this->assertEquals($cpf, preg_replace("/[^0-9]/", "", $Email['document']));
            $this->assertEquals('2018-04-19', date("Y-m-d", strtotime($Email['FirstPassageDate'])));

        }
        /**
         * @dataProvider CPF
         */
        /* public function testvehicles($cpf): void
    {
    $request = $this->PF->vehicles($cpf);
    $this->assertEquals(200, $request->http_status);
    }*/

    }
