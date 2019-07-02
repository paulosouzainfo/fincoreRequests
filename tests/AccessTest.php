<?php
namespace Fincore\Test;

final class AccessTest extends  \PHPUnit\Framework\TestCase {
	
	protected function setUp()
    {
        $this->Access = new \Fincore\Access();
    }

   public function Senhaleatoria()
  {
    return [
      ['email@email.com','mypassword'],
      ['meunovo@email.com','mysenha'],
      ['pepe@gamil.co','teste'],
      ['pepe','teste','testada']
    ];
  }
   /**
   * @dataProvider Senhaleatoria
   */
	public function testeverificarAcesso($email,$password) {
		$retorno=$this->Access->administrative($email,$password);
		$this->assertContains($email,
			     array($retorno['data']['email'],$retorno['data']['password']));
		$this->assertContains($password,
			   array($retorno['data']['email'],$retorno['data']['password']));
    }

 }
