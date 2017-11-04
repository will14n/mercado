<?php

include "../classes/oferta.php";

class OfetaTest extends PHPUnit\Framework\TestCase {

	public function testeOfertaSrc() {
		
		$oferta = new Oferta();
        $oferta->setOfertaSrc("Oferta Src");

        $this->assertEquals("Oferta Src", $oferta->getOfertaSrc());
    }

	public function testeOfertaDescricao() {
		
		$oferta = new Oferta();
        $oferta->setOfertaDescricao("Oferta Descrição");

        $this->assertEquals("Oferta Descrição", $oferta->getOfertaDescricao());
    }

	public function testeInsereProduto() {

		$oferta = new Oferta();
		$oferta->setOfertaSrc("Oferta Src");
		$oferta->setOfertaDescricao("Oferta Descrição");
		$oferta = $oferta->insereOferta();

		$this->assertEquals(
			[
				'src' => "Oferta Src",
				'descricao' => "Oferta Descrição",
			],
			$oferta
		);
	}
}