<?php

include "../classes/produto.php";

class ProdutoTest extends PHPUnit\Framework\TestCase {

	public function testeProdutoPromocaoCodigo() {
		
		$produto = new Produto();
        $produto->setProdutoPromocaoCodigo("Produto Promocao Código");

        $this->assertEquals("Produto Promocao Código", $produto->getProdutoPromocaoCodigo());
    }

	public function testeProdutoDescricao() {
		
		$produto = new Produto();
        $produto->setProdutoDescricao("Produto Descrição");

        $this->assertEquals("Produto Descrição", $produto->getProdutoDescricao());
    }

	public function testeProdutoPreco() {
		
		$produto = new Produto();
        $produto->setProdutoPreco("Produto Preco");

        $this->assertEquals("Produto Preco", $produto->getProdutoPreco());
    }

	public function testeProdutoQuantidade() {
		
		$produto = new Produto();
        $produto->setProdutoQuantidade("Produto Quantidade");

        $this->assertEquals("Produto Quantidade", $produto->getProdutoQuantidade());
    }

	public function testeProdutoObservacao() {
		
		$produto = new Produto();
        $produto->setProdutoObservacao("Produto Observação");

        $this->assertEquals("Produto Observação", $produto->getProdutoObservacao());
    }

	public function testeProdutoIcone() {
		
		$produto = new Produto();
        $produto->setProdutoIcone("Produto Ícone");

        $this->assertEquals("Produto Ícone", $produto->getProdutoIcone());
    }

	public function testeProdutoCategoria() {
		
		$produto = new Produto();
        $produto->setProdutoCategoria("Produto Categoria");

        $this->assertEquals("Produto Categoria", $produto->getProdutoCategoria());
    }

	public function testeInsereProduto() {

		$produto = new Produto();
		$produto->setProdutoPromocaoCodigo("Produto Promocao Código");
		$produto->setProdutoDescricao("Produto Descrição");
		$produto->setProdutoPreco("Produto Preco");
		$produto->setProdutoQuantidade("Produto Quantidade");
		$produto->setProdutoObservacao("Produto Observação");
		$produto->setProdutoIcone("Produto Ícone");
		$produto->setProdutoCategoria("Produto Categoria");
		$produto = $produto->insereProduto();

		$this->assertEquals(
			[
				'cod_promocao' => "Produto Promocao Código",
				'descricao' => "Produto Descrição",
				'preco_unit' => "Produto Preco",
				'qtd_produto' => "Produto Quantidade",
				'observacao' => "Produto Observação",
				'icone' => "Produto Ícone",
				'categoria' => "Produto Categoria"
			],
			$produto
		);
	}
}