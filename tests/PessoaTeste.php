<?php

include "../classes/pessoa.php";

class PessoaTest extends PHPUnit\Framework\TestCase {

    public function testePessoaNome() {
        
        $pessoa = new Pessoa();
        $pessoa->setPessoaNome("Pessoa Nome");
        $this->assertEquals("Pessoa Nome", $pessoa->getPessoaNome());
    }

    public function testePessoaCpf() {
        
        $pessoa = new Pessoa();
        $pessoa->setPessoaCpf("Pessoa Cpf");

        $this->assertEquals("Pessoa Cpf", $pessoa->getPessoaCpf());
    }

	public function testePessoaEndereco() {
		
		$pessoa = new Pessoa();
        $pessoa->setPessoaEndereco("Pessoa Endereco");

        $this->assertEquals("Pessoa Endereco", $pessoa->getPessoaEndereco());
    }

	public function testePessoaTelefone() {
		
		$pessoa = new Pessoa();
        $pessoa->setPessoaTelefone("Pessoa Telefone");

        $this->assertEquals("Pessoa Telefone", $pessoa->getPessoaTelefone());
    }

	public function testePessoaDataNascimento() {
		
		$pessoa = new Pessoa();
        $pessoa->setPessoaDataNascimento("Pessoa Data Nascimento");

        $this->assertEquals("Pessoa Data Nascimento", $pessoa->getPessoaDataNascimento());
    }

	public function testePessoaPaypal() {
		
		$pessoa = new Pessoa();
        $pessoa->setPessoaPaypal("Pessoa Paypal");

        $this->assertEquals("Pessoa Paypal", $pessoa->getPessoaPaypal());
    }

	public function testePessoaEmail() {
		
		$pessoa = new Pessoa();
        $pessoa->setPessoaEmail("Pessoa Email");

        $this->assertEquals("Pessoa Email", $pessoa->getPessoaEmail());
    }

	public function testePessoaLogin() {
		
		$pessoa = new Pessoa();
        $pessoa->setPessoaLogin("Pessoa Login");

        $this->assertEquals("Pessoa Login", $pessoa->getPessoaLogin());
    }

	public function testePessoaSenha() {
		
		$pessoa = new Pessoa();
        $pessoa->setPessoaSenha("Pessoa Senha");

        $this->assertEquals(md5("Pessoa Senha"), $pessoa->getPessoaSenha());
    }

	public function testeInserePessoa() {

		$pessoa = new Pessoa();
		$pessoa->setPessoaNome("Pessoa Nome");
        $pessoa->setPessoaCpf("Pessoa Cpf");
        $pessoa->setPessoaEndereco("Pessoa Endereço");
		$pessoa->setPessoaTelefone("Pessoa Telefone");
		$pessoa->setPessoaDataNascimento("Pessoa Data Nascimento");
		$pessoa->setPessoaPaypal("Pessoa Paypal");
		$pessoa->setPessoaEmail("Pessoa Email");
		$pessoa->setPessoaLogin("Pessoa Login");
		$pessoa->setPessoaSenha("Pessoa Senha");
		$pessoa = $pessoa->inserePessoa();

		$this->assertEquals(
			[
                'pessoaNome' => "Pessoa Nome",
                'pessoaCpf' => "Pessoa Cpf",
				'pessoaEndereco' => "Pessoa Endereço",
				'pessoaTelefone' => "Pessoa Telefone",
				'pessoaDataNascimento' => "Pessoa Data Nascimento",
				'pessoaPaypal' => "Pessoa Paypal",
				'pessoaEmail' => "Pessoa Email",
				'login' => "Pessoa Login",
				'senha' => md5("Pessoa Senha")
			],
			$pessoa
		);
	}
}