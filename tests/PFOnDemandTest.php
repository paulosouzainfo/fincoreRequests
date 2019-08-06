<?php
namespace Fincore\Test;

final class PFOnDemandTest extends \PHPUnit\Framework\TestCase
{
    private $PFOnDemand;

    protected function setup(): void
    {
        $this->PFOnDemand = new \Fincore\PFOnDemand();
        $this->Cpf        = getenv('CPF');
    }

    public function testcriminalRecords(): void
    {
        $request = $this->PFOnDemand->criminalRecords($this->Cpf);

        $this->assertEquals(200, $request->http_status);

        $this->Cpf = preg_replace("/[^0-9]/", "", $this->Cpf);

        $this->assertEquals(
            $this->Cpf, preg_replace(
                "/[^0-9]/",
                "",
                $request->response[0]->document
            )
        );
    }

    public function testibamaEmbargo(): void
    {
        $request = $this->PFOnDemand->ibamaEmbargo($this->Cpf);

        $this->assertEquals(200, $request->http_status);

        $this->Cpf = preg_replace("/[^0-9]/", "", $this->Cpf);

        $this->assertEquals(
            $this->Cpf,
            preg_replace(
                "/[^0-9]/",
                "",
                $request->response[0]->document
            )
        );
    }

    public function testnegativeCertificate(): void
    {
        $request = $this->PFOnDemand->negativeCertificate($this->Cpf);

        $this->assertEquals(200, $request->http_status);

        $this->Cpf = preg_replace("/[^0-9]/", "", $this->Cpf);

        $this->assertEquals(
            $this->Cpf,
            preg_replace(
                "/[^0-9]/",
                "",
                $request->response[0]->document
            )
        );
    }

    public function testpgfn(): void
    {
        $request = $this->PFOnDemand->pgfn($this->Cpf);

        $this->assertEquals(200, $request->http_status);

        $this->Cpf = preg_replace("/[^0-9]/", "", $this->Cpf);

        $this->assertEquals(
            $this->Cpf,
            preg_replace(
                "/[^0-9]/",
                "",
                $request->response[0]->document
            )
        );
    }

    public function testnothingContained(): void
    {
        $request = $this->PFOnDemand->nothingContained($this->Cpf);

        $this->Cpf = preg_replace("/[^0-9]/", "", $this->Cpf);

        $this->assertEquals(
            $this->Cpf, preg_replace(
                "/[^0-9]/",
                "",
                $request->response[0]->document
            )
        );

        $this->assertEquals(200, $request->http_status);
    }

    public function testcpf(): void
    {
        $request = $this->PFOnDemand->cpf($this->Cpf);
        $this->assertEquals(200, $request->http_status);
    }

    public function testhealthPlans(): void
    {
        $request = $this->PFOnDemand->healthPlans($this->Cpf);

        $this->assertEquals(200, $request->http_status);

        $this->Cpf = preg_replace("/[^0-9]/", "", $this->Cpf);

        $this->assertEquals(
            $this->Cpf,
            preg_replace("/[^0-9]/",
                "",
                $request->response[0]->document
            )
        );
    }

    public function testincomeTaxRefunds(): void
    {
        $request = $this->PFOnDemand->incomeTaxRefunds($this->Cpf);

        $this->assertEquals(200, $request->http_status);

        $this->assertEquals(
            $this->Cpf,
            preg_replace("/[^0-9]/",
                "",
                $request->response[0]->document
            )
        );
    }

    /* public function testrais($cpf): void
    {
    $request = $this->PFOnDemand->rais($cpf);
    $this->assertEquals(200, $request->http_status);

    }*/

    /*public function testunemploymentInsurance($cpf): void
{
$request = $this->PFOnDemand->unemploymentInsurance($cpf);
$this->assertEquals(200, $request->http_status);
}*/
}
