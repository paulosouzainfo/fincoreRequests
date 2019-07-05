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
        $this->assertEquals($cpf, $request->response->document);
    }
    /**
     * @dataProvider CPF
     */
    public function testMemberships($cpf): void
    {
        $request = $this->PF->memberships($cpf);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    public function testPublicProfessions($cpf): void
    {
        $request = $this->PF->publicProfessions($cpf);
        $this->assertEquals(200, $request->http_status);
        $this->assertEquals($cpf, $request->response->document);
    }
    /**
     * @dataProvider CPF
     */
    public function testProfessions($cpf): void
    {
        $request = $this->PF->professions($cpf);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    public function testUniversityStudents($cpf): void
    {
        $request = $this->PF->universityStudents($cpf);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    public function testDomains($cpf): void
    {
        $request = $this->PF->domains($cpf);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    //  public function testEmails($cpf): void
    //  {
    //   $request = $this->PF->email($cpf);
    //   $this->assertEquals(200, $request->http_status);

    //}
    /**
     * @dataProvider CPF
     */
    public function testaddresses($cpf): void
    {
        $request = $this->PF->addresses($cpf);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    public function testmediaExposure($cpf): void
    {
        $request = $this->PF->mediaExposure($cpf);
        $this->assertEquals(200, $request->http_status);
        $this->assertEquals($cpf, $request->response->document);
    }
    /**
     * @dataProvider CPF
     */

    public function flagsAndFeatures($cpf): void
    {
        $request = $this->PF->flagsAndFeatures($cpf);
        $this->assertEquals(200, $request->http_status);

    }
    /**
     * @dataProvider CPF
     */
    public function testfinancial($cpf): void
    {
        $request = $this->PF->financial($cpf);
        $this->assertEquals(200, $request->http_status);
        $this->assertEquals($cpf, $request->response->document);

    }
    /**
     * @dataProvider CPF
     */
    public function testkyc($cpf): void
    {
        $request = $this->PF->kyc($cpf);
        $this->assertEquals(200, $request->http_status);
        $this->assertEquals($cpf, $request->response->document);

    }
    /**
     * @dataProvider CPF
     */
    public function testinterests($cpf): void
    {
        $request = $this->PF->interests($cpf);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    public function testwebPassages($cpf): void
    {
        $request = $this->PF->webPassages($cpf);
        $this->assertEquals(200, $request->http_status);

    }
    /**
     * @dataProvider CPF
     */
    public function testonlinePresence($cpf): void
    {
        $request = $this->PF->onlinePresence($cpf);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    public function testrecurrencyToCharging($cpf): void
    {
        $request = $this->PF->recurrencyToCharging($cpf);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    public function testprocesses($cpf): void
    {
        $request = $this->PF->processes($cpf);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    public function testsocialAssistences($cpf): void
    {
        $request = $this->PF->socialAssistences($cpf);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    public function testbusinessRelationships($cpf): void
    {
        $request = $this->PF->businessRelationships($cpf);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    public function testnearbyRelationships($cpf): void
    {
        $request = $this->PF->nearbyRelationships($cpf);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    public function testphones($cpf): void
    {
        $request = $this->PF->phones($cpf);
        $this->assertEquals(200, $request->http_status);
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
