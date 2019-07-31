<?php
namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class PFOnDemandTest extends \PHPUnit\Framework\TestCase
{
    private $PFOnDemand;
    
    protected function setup(): void
    {
        $this->PFOnDemand = new \Fincore\PFOnDemand();
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
    public function testcriminalRecords($cpf): void
    {
        $request = $this->PFOnDemand->criminalRecords($cpf);
        $this->assertEquals(200, $request->http_status);
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $this->assertEquals($cpf, preg_replace("/[^0-9]/", "", $request->response[0]->document));

    }
    /**
     * @dataProvider CPF
     */
    public function testibamaEmbargo($cpf): void
    {
        $request = $this->PFOnDemand->ibamaEmbargo($cpf);
        $this->assertEquals(200, $request->http_status);
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $this->assertEquals($cpf, preg_replace("/[^0-9]/", "", $request->response[0]->document));
    }
    /**
     * @dataProvider CPF
     */
    public function testnegativeCertificate($cpf): void
    {
        $request = $this->PFOnDemand->negativeCertificate($cpf);
        $this->assertEquals(200, $request->http_status);
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $this->assertEquals($cpf, preg_replace("/[^0-9]/", "", $request->response[0]->document));
    }
    /**
     * @dataProvider CPF
     */
    public function testpgfn($cpf): void
    {
        $request = $this->PFOnDemand->pgfn($cpf);
        $this->assertEquals(200, $request->http_status);
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $this->assertEquals($cpf, preg_replace("/[^0-9]/", "", $request->response[0]->document));
    }
    /**
     * @dataProvider CPF
     */
    public function testnothingContained($cpf): void
    {
        $request = $this->PFOnDemand->nothingContained($cpf);
        $cpf     = preg_replace("/[^0-9]/", "", $cpf);
        $this->assertEquals($cpf, preg_replace("/[^0-9]/", "", $request->response[0]->document));
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    public function testcpf($cpf): void
    {
        $request = $this->PFOnDemand->cpf($cpf);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider CPF
     */
    public function testhealthPlans($cpf): void
    {
        $request = $this->PFOnDemand->healthPlans($cpf);
        $this->assertEquals(200, $request->http_status);
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $this->assertEquals($cpf, preg_replace("/[^0-9]/", "", $request->response[0]->document));

    }
    /**
     * @dataProvider CPF
     */
    public function testincomeTaxRefunds($cpf): void
    {
        $request = $this->PFOnDemand->incomeTaxRefunds($cpf);
        $this->assertEquals(200, $request->http_status);
        $this->assertEquals($cpf, preg_replace("/[^0-9]/", "", $request->response[0]->document));

    }
    /**
     * @dataProvider CPF
     */
    /* public function testrais($cpf): void
    {
    $request = $this->PFOnDemand->rais($cpf);
    $this->assertEquals(200, $request->http_status);

    }*/

    /**
     * @dataProvider CPF
     */
    /*public function testunemploymentInsurance($cpf): void
{
$request = $this->PFOnDemand->unemploymentInsurance($cpf);
$this->assertEquals(200, $request->http_status);
}*/
}
