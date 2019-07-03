<?php
namespace Fincore\Test;

$dotenv = \Dotenv\Dotenv::create('./');
$dotenv->load();

final class AdministrativeTest extends \PHPUnit\Framework\TestCase {
	private $Administrative;
	
	protected function setup(): void {
		$this->Administrative = new \Fincore\Administrative();
   }

  public function testListApps() : void {
        $request =$this->Administrative->ListApps();
        $this->assertEquals(200, $request->http_status);      
    }

  public function ID(): array {
     return [
      [ getenv('IDAPP')]
     ];
  }  
  /**
  * @dataProvider ID
  */
  public function testRetrieveApp($id): void {
      $request =$this->Administrative->RetrieveApp($id);
      $this->assertEquals(200, $request->http_status); 
      $this->assertEquals($id, $request->response->_id);     
  }

  public function Novoapp(): array {
     return [
      [ getenv('URL'),getenv('DSN')]
     ];
  }
  /**
  * @dataProvider Novoapp
  */
   public function testNewApp($url,$dsn): void {
      $request =$this->Administrative->NewApp($url,$dsn);
      $this->assertEquals(200, $request->http_status); 
  }
  /**
  * @dataProvider ID
  */
   public function testDisableApps($appId): void {
    $request =$this->Administrative->DisableApps($appId);
    $this->assertEquals(200, $request->http_status);     
  }
  /**
  * @dataProvider ID
  */
  public function testReactivatingApps($appId): void {
    $request =$this->Administrative->ReactivatingApps($appId);
     $this->assertEquals(200, $request->http_status); 
  }

  public function UpdateApp(): array {
        return [
          [ getenv('URL'),getenv('DSN'),getenv('IDAPP')]
        ];
       }
  /**
  * @dataProvider UpdateApp
  */
  public function testUpdatingApps($url,$dsn,$appId): void {
    $request =$this->Administrative->UpdatingApps($url,$dsn,$appId);
    $this->assertEquals(200, $request->http_status); 
  }
}
