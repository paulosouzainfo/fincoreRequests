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
   public function testAds($cpf): void {
    $request =$this->PF->ads($cpf);
    $this->assertEquals(200, $request->http_status);   
    
  }
  /**
  * @dataProvider CPF
  */
  public function testBasic($cpf): void {
    $request =$this->PF->basic($cpf);
    $this->assertEquals(200, $request->http_status);
    $this->assertEquals($cpf, $request->response->document);
 
  }
   /**
  * @dataProvider CPF
  */

  public function testMemberships($cpf): void {
    $request =$this->PF->memberships($cpf);
    $this->assertEquals(200, $request->http_status);
  }
   /**
  * @dataProvider CPF
  */

  public function testPublicProfessions($cpf): void {
    $request =$this->PF->publicProfessions($cpf);
    $this->assertEquals(200, $request->http_status);  
    $this->assertEquals($cpf, $request->response->document);
   
  }
  /**
  * @dataProvider CPF
  */

  public function testProfessions($cpf): void {
    $request =$this->PF->professions($cpf); 
    $this->assertEquals(200, $request->http_status); 
  }
  /**
  * @dataProvider CPF
  */

  public function testUniversityStudents($cpf): void {
    $request =$this->PF->universityStudents($cpf); 
     $this->assertEquals(200, $request->http_status); 
  }

   /**
  * @dataProvider CPF
  */

  public function testDomains($cpf): void {
   $request =$this->PF->domains($cpf); 
   var_dump($request);
   $this->assertEquals(200, $request->http_status); 
   
  }

  /**
  * @dataProvider CPF
  */

  public function testEmails($cpf): void {
    $request =$this->PF->email($cpf); 
     $this->assertEquals(200, $request->http_status); 

  }

  /*public function testPersonsEmails($cpf): void {
    $request =$this->PF->PersonsEmails($cpf); 
    $this->assertEquals(200, $request->http_status); 
  }*/

  

}