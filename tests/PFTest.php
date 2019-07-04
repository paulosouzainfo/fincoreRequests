<?php
namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class PFTest extends \PHPUnit\Framework\TestCase {
  private $PF;

  protected function setup(): void {
    $this->PF = new \Fincore\PF();
   }
  public function CPF(): array {
    return [
      [getenv('CPF')]
    ];
  }
 /**
  * @dataProvider CPF
  */
   public function testOnlineAds($cpf): void {
    $request =$this->PF->OnlineAds($cpf);
    $this->assertEquals(200, $request->http_status);   
    
  }
  /**
  * @dataProvider CPF
  */
  public function testBasicCadastral($cpf): void {
    $request =$this->PF->BasicCadastral($cpf);
    $this->assertEquals(200, $request->http_status);
    $this->assertEquals($cpf, $request->response->document);
 
  }
   /**
  * @dataProvider CPF
  */

  public function testClassAdvice($cpf): void {
    $request =$this->PF->ClassAdvice($cpf);
    $this->assertEquals(200, $request->http_status);
  }



  

}