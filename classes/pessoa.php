<?php

class Pessoa {

	private $pessoaNome;
	private $pessoaCpf;
	private	$pessoaEndereco;
	private	$pessoaTelefone;
	private	$pessoaDataNascimento;
	private	$pessoaPaypal;
	private	$pessoaEmail;
	private	$pessoaLogin;
	private	$pessoaSenha;
	
	function setPessoaNome($pessoaNome) {
		$this->pessoaNome = $pessoaNome;
	}
	function getpessoaNome() {
		return $this->pessoaNome;
	}

	function setPessoaCpf($pessoaCpf) {
		$this->pessoaCpf = $pessoaCpf;
	}
	function getpessoaCpf() {
		return $this->pessoaCpf;
	}

	function setPessoaEndereco($pessoaEndereco) {
		$this->pessoaEndereco = $pessoaEndereco;
	}
	function getpessoaEndereco() {
		return $this->pessoaEndereco;
	}

	function setPessoaTelefone($pessoaTelefone) {
		$this->pessoaTelefone = $pessoaTelefone;
	}
	function getpessoaTelefone() {
		return $this->pessoaTelefone;
	}

	function setPessoaDataNascimento($pessoaDataNascimento) {
		$this->pessoaDataNascimento = $pessoaDataNascimento;
	}
	function getpessoaDataNascimento() {
		return $this->pessoaDataNascimento;
	}

	function setPessoaPaypal($pessoaPaypal) {
		$this->pessoaPaypal = $pessoaPaypal;
	}
	function getpessoaPaypal() {
		return $this->pessoaPaypal;
	}

	function setPessoaEmail($pessoaEmail) {
		$this->pessoaEmail = $pessoaEmail;
	}
	function getpessoaEmail() {
		return $this->pessoaEmail;
	}

	function setPessoaLogin($pessoaLogin) {
		$this->pessoaLogin = $pessoaLogin;
	}
	function getpessoaLogin() {
		return $this->pessoaLogin;
	}

	function setPessoaSenha($pessoaSenha) {
		$this->pessoaSenha = $pessoaSenha;
	}
	function getpessoaSenha() {
		return md5($this->pessoaSenha);
	}

	function inserePessoa() {
		$con = [
			'pessoaNome' => $this->getPessoaNome(),
			'pessoaCpf' => $this->getPessoaCpf(),
			'pessoaEndereco' => $this->getPessoaEndereco(),
			'pessoaTelefone' => $this->getPessoaTelefone(),
			'pessoaDataNascimento' => $this->getPessoaDataNascimento(),
			'pessoaPaypal' => $this->getPessoaPaypal(),
			'pessoaEmail' => $this->getPessoaEmail(),
			'login' => $this->getPessoaLogin(),
			'senha' => $this->getPessoaSenha(),
		];

		return $con;       
	}
}