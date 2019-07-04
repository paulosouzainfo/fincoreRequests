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
    var_dump($request);
    
  }



  

}