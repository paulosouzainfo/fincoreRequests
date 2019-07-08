<?php
namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class EmailsTest extends \PHPUnit\Framework\TestCase {
  private $Emails;
  
  protected function setup(): void {
    $this->Emails = new \Fincore\Emails();
   }

  public function Email(): array {
    return [
      [getenv('EMAIL')]
    ];
  }
 /**
  * @dataProvider Email
  */

  /* public function testSearchNetworks($email): void {
    $request = $this->Emails->SearchNetworks($email);
    //var_dump($request);
    
  }*/




}