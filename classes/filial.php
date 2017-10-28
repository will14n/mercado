<?php

class Filial {

	private $filialCodigo;
	private	$filialNome;
	private	$filialEndereco;
	private	$filialObservacao;
	
	function setFilialCodigo($filialCodigo) {
		$this->filialCodigo = $filialCodigo;
	}
	function getFilialCodigo() {
		return $this->filialCodigo;
	}

	function setFilialNome($filialNome) {
		$this->filialNome = $filialNome;
	}
	function getFilialNome() {
		return $this->filialNome;
	}

	function setFilialEndereco($filialEndereco) {
		$this->filialEndereco = $filialEndereco;
	}
	function getFilialEndereco() {
		return $this->filialEndereco;
	}

	function setFilialObservacao($filialObservacao) {
		$this->filialObservacao = $filialObservacao;
	}
	function getFilialObservacao() {
		return $this->filialObservacao;
	}

	function insereFilial() {
		$con = [
			'cod_filial' => $this->getFilialCodigo(),
			'nome' => $this->getFilialNome(),
			'endereco' => $this->getFilialEndereco(),
			'observacao' => $this->getFilialObservacao(),
		];

		return $con;       
	}
}