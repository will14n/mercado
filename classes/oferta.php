<?php

class Oferta {

	private $ofertaSrc;
	private	$ofertaDescricao;
	
	function setOfertaSrc($ofertaSrc) {
		$this->ofertaSrc = $ofertaSrc;
	}
	function getOfertaSrc() {
		return $this->ofertaSrc;
	}

	function setOfertaDescricao($ofertaDescricao) {
		$this->ofertaDescricao = $ofertaDescricao;
	}
	function getOfertaDescricao() {
		return $this->ofertaDescricao;
	}

	function insere() {
		$con = [
			'src' => $this->getOfertaSrc(),
			'descricao' => $this->getOfertaDescricao(),
		];

		return $con;       
	}
}