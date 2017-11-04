<?php

include "../classes/filial.php";

class FilialTest extends PHPUnit\Framework\TestCase {

    public function testeFilialCodigo() {
        
        $filial = new Filial();
        $filial->setFilialCodigo("Filial Código");

        $this->assertEquals("Filial Código", $filial->getFilialCodigo());
    }

    public function testeFilialNome() {
        
        $filial = new Filial();
        $filial->setFilialNome("Filial Nome");

        $this->assertEquals("Filial Nome", $filial->getFilialNome());
    }

    public function testeFilialEndereco() {
		
		$filial = new Filial();
        $filial->setFilialEndereco("Filial Endereço");

        $this->assertEquals("Filial Endereço", $filial->getFilialEndereco());
    }

	public function testeFilialObservacao() {
		
		$filial = new Filial();
        $filial->setFilialObservacao("Filial Observação");

        $this->assertEquals("Filial Observação", $filial->getFilialObservacao());
    }

	public function testeInsereProduto() {

		$filial = new Filial();
        $filial->setFilialCodigo("Filial Código");
        $filial->setFilialNome("Filial Nome");
		$filial->setFilialEndereco("Filial Endereço");
		$filial->setFilialObservacao("Filial Observação");
		$filial = $filial->insereFilial();

		$this->assertEquals(
			[
                'cod_filial' => "Filial Código",
                'nome' => "Filial Nome",
				'endereco' => "Filial Endereço",
				'observacao' => "Filial Observação",
			],
			$filial
		);
	}
}