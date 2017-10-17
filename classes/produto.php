<?php

class Produto {

	private $produtoPromocaoCodigo;
	private	$produtoDescricao;
	private	$produtoPreco;
	private	$produtoQuantidade;
	private	$produtoObservacao;
	private	$produtoIcone;
	private	$produtoCategoria;

	function setProdutoPromocaoCodigo($produtoPromocaoCodigo) {
		$this->produtoPromocaoCodigo = $produtoPromocaoCodigo;
	}
	function getProdutoPromocaoCodigo() {
		return $this->produtoPromocaoCodigo;
	}

	function setProdutoDescricao($produtoDescricao) {
		$this->produtoDescricao = $produtoDescricao;
	}
	function getProdutoDescricao() {
		return $this->produtoDescricao;
	}

	function setProdutoPreco($produtoPreco) {
		$this->produtoPreco = $produtoPreco;
	}
	function getProdutoPreco() {
		return $this->produtoPreco;
	}

	function setProdutoQuantidade($produtoQuantidade) {
		$this->produtoQuantidade = $produtoQuantidade;
	}
	function getProdutoQuantidade() {
		return $this->produtoQuantidade;
	}

	function setProdutoObservacao($produtoObservacao) {
		$this->produtoObservacao = $produtoObservacao;
	}
	function getProdutoObservacao() {
		return $this->produtoObservacao;
	}

	function setProdutoIcone($produtoIcone) {
		$this->produtoIcone = $produtoIcone;
	}
	function getProdutoIcone() {
		return $this->produtoIcone;
	}

	function setProdutoCategoria($produtoCategoria) {
		$this->produtoCategoria = $produtoCategoria;
	}
	function getProdutoCategoria() {
		return $this->produtoCategoria;
	}

	function insereProduto() {
		$con=[
			'cod_promocao' => $this->getProdutoPromocaoCodigo(),
			'descricao' => $this->getProdutoDescricao(),
			'preco_unit' => $this->getProdutoPreco(),
			'qtd_produto' => $this->getProdutoQuantidade(),
			'observacao' => $this->getProdutoObservacao(),
			'icone' => $this->getProdutoIcone(),
			'categoria' => $this->getProdutoCategoria()
		];

		return $con;       
	}
}