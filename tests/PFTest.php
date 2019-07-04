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
   /**
  * @dataProvider CPF
  */

  public function testPublicPprofessions($cpf): void {
    $request =$this->PF->PublicPprofessions($cpf);
    $this->assertEquals(200, $request->http_status);  
    $this->assertEquals($cpf, $request->response->document);
   
  }
  /**
  * @dataProvider CPF
  */

  public function testUniversitySstudents($cpf): void {
    $request =$this->PF->UniversitySstudents($cpf); 
    $this->assertEquals(200, $request->http_status); 
  }
  /**
  * @dataProvider CPF
  */

  public function testPersonsDomains($cpf): void {
    $request =$this->PF->PersonsDomains($cpf); 
     $this->assertEquals(200, $request->http_status); 
  }

   /**
  * @dataProvider CPF
  */

  public function testPersonsAddresses($cpf): void {
   $request =$this->PF->PersonsAddresses($cpf); 
   var_dump($request);
   $this->assertEquals(200, $request->http_status); 
   
  }

  /**
  * @dataProvider CPF
  */

  public function testPersonsMediaExposure($cpf): void {
    $request =$this->PF->PersonsMediaExposure($cpf); 
     $this->assertEquals(200, $request->http_status); 

  }

  /*public function testPersonsEmails($cpf): void {
    $request =$this->PF->PersonsEmails($cpf); 
    $this->assertEquals(200, $request->http_status); 
  }*/

  

}