<?php

include "../classes/conectaHeroku.php";

class ConectarTest extends PHPUnit\Framework\TestCase {

	public function testeServidor() {
		
		$conectaHeroku = new Conectar();
		$conectaHeroku->setServidor("Servidor");

		$this->assertEquals("Servidor", $conectaHeroku->getServidor());
	}

	public function testeUserCon() {
		
		$conectaHeroku = new Conectar();
		$conectaHeroku->setUserCon("UserCon");

		$this->assertEquals("UserCon", $conectaHeroku->getUserCon());
	}

	public function testePwdCon() {
		
		$conectaHeroku = new Conectar();
		$conectaHeroku->setPwdCon("PwdCon");

		$this->assertEquals("PwdCon", $conectaHeroku->getPwdCon());
	}

	public function testeBaseCon() {
		
		$conectaHeroku = new Conectar();
		$conectaHeroku->setBaseCon("BaseCon");

		$this->assertEquals("BaseCon", $conectaHeroku->getBaseCon());
	}

	public function testeCon() {
		
		$conectaHeroku = new Conectar();
		$conectaHeroku->setCon("Con");

		$this->assertEquals("Con", $conectaHeroku->getCon());
	}

	public function testeBaseCons() {
		
		$conectaHeroku = new Conectar();
		$conectaHeroku->setBaseCons("BaseCons");

		$this->assertEquals("BaseCons", $conectaHeroku->getBaseCons());
	}
}