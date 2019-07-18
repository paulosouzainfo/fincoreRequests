<?php

namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class AppsTest extends \PHPUnit\Framework\TestCase
{

    protected function setup(): void
    {
        $this->Apps = new \Fincore\Apps();
    }
    public function testDocumentsUpdate()
    {
        $collection = getenv('COLLECTION');
        $filter     = array('tipo' => 'Filho');
        $Options    = array('idade' => '50');
        $request    = $this->Apps->DocumentsUpdate($collection, $filter, $Options);
        var_dump($request);

    }

}
