<?php
namespace Fincore\Test;

final class PJOnDemandTest extends \PHPUnit\Framework\TestCase
{
    private $PJOnDemand;

    protected function setup(): void
    {
        $this->PJOnDemand = new \Fincore\PJOnDemand();
        $this->Cnpj       = getenv('CNPJ');
    }

    public function testibamaEmbargo(): void
    {
        $request = $this->PJOnDemand->ibamaEmbargo($this->Cnpj);

        $this->assertEquals(200, $request->http_status);

        $this->Cnpj = preg_replace("/[^0-9]/", "", $this->Cnpj);

        $this->assertEquals(
            $this->Cnpj,
            preg_replace("/[^0-9]/",
                "",
                $request->response[0]->document
            )
        );
    }

    public function testibamaNegativeCertificate(): void
    {
        $request = $this->PJOnDemand->ibamaNegativeCertificate($this->Cnpj);

        $this->assertEquals(200, $request->http_status);

        $this->Cnpj = preg_replace("/[^0-9]/", "", $this->Cnpj);

        $this->assertEquals(
            $this->Cnpj,
            preg_replace("/[^0-9]/",
                "",
                $request->response[0]->document
            )
        );
    }

    /*public function testpgfn($cnpj): void
    {
    $request = $this->PJOnDemand->pgfn($cnpj);
    $this->assertEquals(200, $request->http_status);

    }*/

    public function testsiproquim(): void
    {
        $request = $this->PJOnDemand->siproquim($cnpj);

        $this->assertEquals(200, $request->http_status);

        $this->Cnpj = preg_replace("/[^0-9]/", "", $this->Cnpj);

        $this->assertEquals(
            $this->Cnpj,
            preg_replace("/[^0-9]/",
                "",
                $request->response[0]->document
            )
        );
    }

    /*public function testcnpj($cnpj): void
    {
    $request = $this->PJOnDemand->cnpj($cnpj);
    $this->assertEquals(200, $request->http_status);
    }*/

    public function testqsa(): void
    {
        $request = $this->PJOnDemand->qsa($this->Cnpj);

        $this->assertEquals(200, $request->http_status);

        $this->Cnpj = preg_replace("/[^0-9]/", "", $this->Cnpj);

        $this->assertEquals(
            $this->Cnpj,
            preg_replace("/[^0-9]/",
                "",
                $request->response[0]->document
            )
        );
    }

    public function testfgts(): void
    {
        $request = $this->PJOnDemand->fgts($this->Cnpj);

        $this->assertEquals(200, $request->http_status);

        $this->Cnpj = preg_replace("/[^0-9]/", "", $this->Cnpj);
        $this->assertEquals(
            $this->Cnpj,
            preg_replace("/[^0-9]/",
                "",
                $request->response[0]->document
            )
        );
    }

    public function testlegalRepresentative(): void
    {
        $request = $this->PJOnDemand->legalRepresentative($this->Cnpj);

        $this->assertEquals(200, $request->http_status);
    }

    public function testsimples(): void
    {
        $request = $this->PJOnDemand->simples($this->Cnpj);
        
        $this->assertEquals(200, $request->http_status);
    }
}
