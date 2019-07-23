<?php

namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class PJOnDemandTest extends \PHPUnit\Framework\TestCase
{

    private $PJOnDemand;
    protected function setup(): void
    {
        $this->PJOnDemand = new \Fincore\PJOnDemand();
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
    /*public function testibamaEmbargo($cnpj): void
    {
    $request = $this->PJOnDemand->ibamaEmbargo($cnpj);
    $this->assertEquals(200, $request->http_status);
    }*/
    /**
     * @dataProvider Cnpj
     */
    public function testibamaNegativeCertificate($cnpj): void
    {
        $request = $this->PJOnDemand->ibamaNegativeCertificate($cnpj);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider Cnpj
     */
    /*public function testpgfn($cnpj): void
    {
    $request = $this->PJOnDemand->pgfn($cnpj);

    $this->assertEquals(200, $request->http_status);

    }*/
    /**
     * @dataProvider Cnpj
     */
    public function testsiproquim($cnpj): void
    {
        $request = $this->PJOnDemand->siproquim($cnpj);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider Cnpj
     */
    /* public function testcnpj($cnpj): void
    {
    $request = $this->PJOnDemand->cnpj($cnpj);

    $this->assertEquals(200, $request->http_status);
    }*/
    /**
     * @dataProvider Cnpj
     */
    public function testqsa($cnpj): void
    {
        $request = $this->PJOnDemand->qsa($cnpj);
        $this->assertEquals(200, $request->http_status);
    }
    /**
     * @dataProvider Cnpj
     */
    public function testfgts($cnpj): void
    {
        $request = $this->PJOnDemand->fgts($cnpj);
        $this->assertEquals(200, $request->http_status);

    }
    /**
     * @dataProvider Cnpj
     */
    public function testlegalRepresentative($cnpj): void
    {
        $request = $this->PJOnDemand->legalRepresentative($cnpj);
        $this->assertEquals(200, $request->http_status);

    }
    /**
     * @dataProvider Cnpj
     */
    public function testsimples($cnpj): void
    {

        $request = $this->PJOnDemand->simples($cnpj);
        $this->assertEquals(200, $request->http_status);
    }
}
