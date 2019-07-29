<?php

namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class UtilitiesTest extends \PHPUnit\Framework\TestCase
{
    private $Utilities;
    protected function setup(): void
    {
        $this->Utilities = new \Fincore\Utilities();
    }
    public function testJsonToXls()
    {
        $data       = ['a' => 1, 'b' => 1];
        $request    = $this->Utilities->JsonToXls($data);
        $file_path  = str_replace('File criado com sucesso em ', '', $request->response);
        list($pasta, $subpasta) = explode('/', $file_path);
        $this->assertDirectoryExists($pasta);
        $this->assertDirectoryExists($pasta . '/' . $subpasta);
        $this->assertFileExists($file_path);
        $this->assertFileIsReadable($file_path);
        $this->assertFileIsWritable($file_path);
        $this->assertEquals(200, $request->http_status);
        $this->assertEquals(true, unlink($file_path));
        $this->assertEquals(true, rmdir($pasta . '/' . $subpasta));
        $this->assertEquals(true, rmdir($pasta));
    }
}
