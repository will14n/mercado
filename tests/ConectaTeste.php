<?php

include "../classes/conecta.php";

class ConectarTest extends PHPUnit\Framework\TestCase {

	public function testeServidor() {
		
		$conecta = new Conectar();
		$conecta->setServidor("Servidor");

		$this->assertEquals("Servidor", $conecta->getServidor());
	}

	public function testeUserCon() {
		
		$conecta = new Conectar();
		$conecta->setUserCon("UserCon");

		$this->assertEquals("UserCon", $conecta->getUserCon());
	}

	public function testePwdCon() {
		
		$conecta = new Conectar();
		$conecta->setPwdCon("PwdCon");

		$this->assertEquals("PwdCon", $conecta->getPwdCon());
	}

	public function testeBaseCon() {
		
		$conecta = new Conectar();
		$conecta->setBaseCon("BaseCon");

		$this->assertEquals("BaseCon", $conecta->getBaseCon());
	}

	public function testeCon() {
		
		$conecta = new Conectar();
		$conecta->setCon("Con");

		$this->assertEquals("Con", $conecta->getCon());
	}

	public function testeBaseCons() {
		
		$conecta = new Conectar();
		$conecta->setBaseCons("BaseCons");

		$this->assertEquals("BaseCons", $conecta->getBaseCons());
	}
}