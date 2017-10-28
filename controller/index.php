<?php
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);
// include_once '../classes/conecta.php'; #CLASSE DE CONEXAO LOCAL
include '../classes/pessoa.php';
include '../classes/filial.php';
include '../classes/produto.php';
include '../classes/oferta.php';
include_once '../classes/conectaHeroku.php'; #CLASSE DE CONEXAO HEROKU
require_once("../lib/raelgc/view/Template.php");
use raelgc\view\Template;
?>
<?php
include_once '../pages/header.html';
include_once '../pages/headerLogo.html';
$tpl = new Template("../pages/nav.html");

if(isset($_GET['logout'])) {

	$_SESSION['autentica'] = false;
	session_destroy();
	header('location: ./index.php?page=index');
	exit;
}

if($_SESSION['autentica'] == "true") {
	$tpl->ACESSO = "../controller/index.php?page=login";
	// $tpl->addFile("DADOS", "../pages/nav.html");
	$tpl->block("BLOCK_LOGOUT");
}
else {
	$tpl->ACESSO = "#";
	$tpl->DROPDOWN = "dropdown";	
	$tpl->block("BLOCK_LOGIN");
}

if($_GET['page'] == 'index') {
	$tpl->ATIVA_INDEX = 'active';
}
else if($_GET['page'] == 'filiais') {
	$tpl->ATIVA_FILIAIS = 'active';
}
else if($_GET['page'] == 'login') {
	$tpl->ATIVA_LOGIN = 'active';
}
else if($_GET['page'] == 'oferta') {
	$tpl->ATIVA_OFERTA = 'active';
}
else if($_GET['page'] == 'promocao') {
	$tpl->ATIVA_PROMOCAO_MENU = 'active';
	$tpl->ATIVA_PROMOCAO = 'active';
}
else if($_GET['page'] == 'atacado') {
	$tpl->ATIVA_PROMOCAO_MENU = 'active';
	$tpl->ATIVA_ATACADO = 'active';
}
else if($_GET['page'] == 'varejo') {
	$tpl->ATIVA_PROMOCAO_MENU = 'active';
	$tpl->ATIVA_VAREJO = 'active';
}
else if($_GET['page'] == 'cadastros') {
	$tpl->ATIVA_LOGIN = 'active';
}
else {
	$tpl->ATIVA_INDEX = 'active';	
}
$tpl->show();

$tpl = new Template("../pages/dados.html");
if($_GET['page'] == 'filiais') {

	$projecao = ['_id' => 0];

	$filiais = new Conectar();
	$filiais->setServidor('localhost');
	$filiais->setUserCon('root');
	$filiais->setPwdCon('root');
	$filiais->setBaseCon('admin');
	$filiais->setCon([NULL], $projecao);
	$filiais->setBaseCons('mercado.filiais');

	$tpl->addFile("DADOS", "../pages/filiais.html");
	
	foreach ($filiais->conecta() as $p) {

		// print_r($p);exit;
	    $tpl->NOME = $p->nome;
	    $tpl->ENDERECO = $p->endereco;
	    $tpl->OBSERVACAO = $p->observacao;
	    $tpl->block("BLOCK_FILIAIS");

    }
}
else if($_GET['page'] == 'login' && $_GET['tipo'] == 'cadastroFilial'){
	$tpl->addFile("DADOS", "../pages/cadastros.html");
}
else if($_GET['page'] == 'login' && $_GET['tipo'] == 'cadastroProduto'){
	$tpl->addFile("DADOS", "../pages/cadastros.html");
}
else if($_GET['page'] == 'login' && $_GET['tipo'] == 'cadastroOferta'){
	$tpl->addFile("DADOS", "../pages/cadastros.html");
}
else if($_GET['page'] == 'login') {
	if($_SESSION['autentica'] == "true") {
		if($_POST['cadastro']) {

			$tpl->addFile("DADOS", "../pages/cadastrado.html");
			if($_POST['cancelar'] == 'Submit') {
				header('location: ./index.php?page=login');
				exit;
			}
			else if($_POST['pessoa']) {

				$pessoa = new Pessoa();
				$pessoa->setPessoaNome($_POST['pessoaNome']);
				$pessoa->setPessoaCpf($_POST['pessoaCpf']);
				$pessoa->setPessoaEndereco($_POST['pessoaEndereco']);
				$pessoa->setPessoaTelefone($_POST['pessoaTelefone']);
				$pessoa->setPessoaDataNascimento($_POST['pessoaDataNascimento']);
				$pessoa->setPessoaPaypal($_POST['pessoaPaypal']);
				$pessoa->setPessoaEmail($_POST['pessoaEmail']);
				$pessoa->setPessoaLogin($_POST['pessoaLogin']);
				$pessoa->setPessoaSenha($_POST['pessoaSenha']);
				$pessoa = $pessoa->inserePessoa();

				$cadastrar = new Conectar();
				$cadastrar->setBaseCon('admin');
				$cadastrar->setCon($pessoa);
				$cadastrar->setBaseCons('mercado.usuarios');
				$cadastrar->insere();

				header('location: ./index.php?page=cadastrado&tipo=pessoa');
				exit;
			}
			else if($_POST['filial']) {

				$filial = new Filial();
				$filial->setFilialCodigo($_POST['filialCodigo']);
				$filial->setFilialNome($_POST['filialNome']);
				$filial->setFilialEndereco($_POST['filialEndereco']);
				$filial->setFilialObservacao($_POST['filialObservacao']);
				$filial = $filial->insereFilial();

				$cadastrar = new Conectar();
				$cadastrar->setBaseCon('admin');
				$cadastrar->setCon($filial);
				$cadastrar->setBaseCons('mercado.filiais');
				$cadastrar->insere();

				header('location: ./index.php?page=cadastrado&tipo=filial');
				exit;
			}
			else if($_POST['oferta']) {

				$oferta = new Oferta();
				$oferta->setOfertaSrc($_POST['ofertaCaminho']);
				$oferta->setOfertaDescricao($_POST['ofertaDescricao']);
				$oferta = $oferta->insereOferta();


				$cadastrar = new Conectar();
				$cadastrar->setBaseCon('admin');
				$cadastrar->setCon($oferta);
				$cadastrar->setBaseCons('mercado.oferta');
				$cadastrar->insere();

				header('location: ./index.php?page=cadastrado&tipo=oferta');				
				exit();
			}
			else if($_POST['produto']) {

				if($_POST['produtoCategoria']['promocao']) {
					$categoria = "promocao";
				}
				else if($_POST['produtoCategoria']['atacado']) {
					$categoria = "atacado";
				}
				else if($_POST['produtoCategoria']['varejo']) {
					$categoria = "varejo";
				}

				$produto = new Produto();
				$produto->setProdutoPromocaoCodigo($_POST['promocaoCodigo']);
				$produto->setProdutoDescricao($_POST['produtoDescricao']);
				$produto->setProdutoPreco($_POST['produtoPreco']);
				$produto->setProdutoQuantidade($_POST['produtoQuantidade']);
				$produto->setProdutoObservacao($_POST['produtoObservacao']);
				$produto->setProdutoIcone($_POST['produtoIcone']);
				$produto->setProdutoCategoria($categoria);
				$produto = $produto->insereProduto();

				$cadastrar = new Conectar();
				$cadastrar->setBaseCon('admin');
				$cadastrar->setCon($produto);
				$cadastrar->setBaseCons('mercado.promocao');
				$cadastrar->insere();

				header('location: ./index.php?page=cadastrado&tipo=produto');
				exit();
			}
		}
		else {
			$tpl->addFile("DADOS", "../pages/login.html");

			$projecao = ['_id' => current($_SESSION['id'])];

			$usuario = new Conectar();
			$usuario->setServidor('localhost');
			$usuario->setUserCon('root');
			$usuario->setPwdCon('root');
			$usuario->setBaseCon('admin');
			$usuario->setCon([NULL], $projecao);
			$usuario->setBaseCons('mercado.usuario');
			print_r($usuario->conecta());exit;
			foreach($usuario->conecta() as $p) {

				print_r($p);exit;
			    $tpl->NOME = $p->nome;
			    $tpl->ENDERECO = $p->endereco;
			    $tpl->OBSERVACAO = $p->observacao;
			    $tpl->block("BLOCK_FILIAIS");

		    }
			$tpl->ENDERECO = $p->pessoaEndereco;
			$tpl->EMAIL = $p->pessoaEmail;
			$tpl->CPF = $p->pessoaCpf;
			$tpl->TELEFONE = $p->pessoaTelefone;
			$tpl->DTNASCIMENTO = $p->pessoaDataNascimento;
			$tpl->Paypal = $p->pessoaPaypal;
			$tpl->LOGIN = $p->pessoaLogin;
			
			if($_SESSION['usuario'] == 'admin') {
				$tpl->block("BLOCK_CADASTRO");
			}
		}
	}
	else {
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($_POST['cadastrar']) {

				$tpl->addFile("DADOS", "../pages/cadastros.html");
				$tpl->block("BLOCK_CADASTRO_PESSOA");				
			}
			else {

				$projecao = ['_id' => 0];

				$teste = new Conectar();
				$teste->setServidor('localhost');
				$teste->setUserCon('root');
				$teste->setPwdCon('root');
				$teste->setBaseCon('admin');
				$teste->setCon([NULL], $projecao);
				$teste->setBaseCons('mercado.usuarios');

				foreach ($teste->conecta() as $p) {

					if(md5($_POST['pwd']) === $p->senha) {

						$_SESSION['autentica'] = "true";
						$_SESSION['usuario'] = $_POST['usr'];
						$_SESSION['login'] = $p->pessoaLogin;
						$_SESSION['id'] =$p->_id;

						header('location: ./index.php?page=login');
						break;
						exit();
					}
					else{
						continue;
					}
				}
				$tpl->addFile("DADOS", "../pages/cadastrado.html");
				$tpl->block("BLOCK_LOGIN_INCORRETO");
			}
		}
	}
}
else if($_GET['page'] == 'oferta') {

	$projecao = ['_id' => 0];

	$oferta = new Conectar();
	$oferta->setServidor('localhost');
	$oferta->setUserCon('root');
	$oferta->setPwdCon('root');
	$oferta->setBaseCon('admin');
	$oferta->setCon([NULL], $projecao);
	$oferta->setBaseCons('mercado.oferta');

	$tpl->addFile("DADOS", "../pages/oferta.html");

	foreach ($oferta->conecta() as $p) {

	    $tpl->CAMINHO = $p->src;
	    $tpl->DESCRICAO = $p->descricao;
	    $tpl->block("BLOCK_OFERTA");
    }
}
else if($_GET['page'] == 'promocao') {

	$projecao = ['_id' => 0];

	$promocao = new Conectar();
	$promocao->setServidor('localhost');
	$promocao->setUserCon('root');
	$promocao->setPwdCon('root');
	$promocao->setBaseCon('admin');
	$promocao->setCon([NULL], $projecao);
	$promocao->setBaseCons('mercado.promocao');

	$tpl->addFile("DADOS", "../pages/promocao.html");
	$tpl->TITULO = "Promoção";
	
	foreach ($promocao->conecta() as $p) {

		if($p->categoria == 'promocao') {

		    $tpl->DESCRICAO = $p->descricao;
		    $tpl->OBSERVACAO = $p->observacao;
		    $tpl->ICONE = $p->icone;
		    $tpl->block("BLOCK_PROMOCOES");
		}
    }
}
else if($_GET['page'] == 'atacado') {

	$projecao = ['_id' => 0];

	$atacado = new Conectar();
	$atacado->setServidor('localhost');
	$atacado->setUserCon('root');
	$atacado->setPwdCon('root');
	$atacado->setBaseCon('admin');
	$atacado->setCon([NULL], $projecao);
	$atacado->setBaseCons('mercado.promocao');

	$tpl->addFile("DADOS", "../pages/promocao.html");
	$tpl->TITULO = "Atacado";
	
	foreach ($atacado->conecta() as $p) {

		if($p->categoria == 'atacado') {

			// print_r($p);exit;
		    $tpl->DESCRICAO = $p->descricao;
		    $tpl->OBSERVACAO = $p->observacao;
		    $tpl->ICONE = $p->icone;
		    $tpl->block("BLOCK_PROMOCOES");
		}
    }
}
else if($_GET['page'] == 'varejo') {

	$projecao = ['_id' => 0];

	$varejo = new Conectar();
	$varejo->setServidor('localhost');
	$varejo->setUserCon('root');
	$varejo->setPwdCon('root');
	$varejo->setBaseCon('admin');
	$varejo->setCon([NULL], $projecao);
	$varejo->setBaseCons('mercado.promocao');

	$tpl->addFile("DADOS", "../pages/promocao.html");
	$tpl->TITULO = "Varejo";

	foreach ($varejo->conecta() as $p) {

		if($p->categoria == 'varejo') {
			// print_r($p);exit;
		    $tpl->DESCRICAO = $p->descricao;
		    $tpl->OBSERVACAO = $p->observacao;
		    $tpl->ICONE = $p->icone;
		    $tpl->block("BLOCK_PROMOCOES");
		}
    }
}
else if($_GET['page'] == 'cadastro'){
	$tpl->addFile("DADOS", "../pages/cadastrado.html");
	$tpl->NOME = $_SESSION['usuario'];
}
else if($_GET['page'] == 'cadastros'){
	$tpl->addFile("DADOS", "../pages/cadastros.html");
	
	if($_GET['tipo'] == "cadastroPessoa") {
		$tpl->block("BLOCK_CADASTRO_PESSOA");
	}
	if($_GET['tipo'] == "cadastroFilial") {
		$tpl->block("BLOCK_CADASTRO_FILIAL");
	}
	else if($_GET['tipo'] == "cadastroOferta") {
		$tpl->block("BLOCK_CADASTRO_OFERTA");
	}
	else if($_GET['tipo'] == "cadastroProduto") {
		$tpl->block("BLOCK_CADASTRO_PRODUTO");
	}
}
else if($_GET['page'] == 'cadastrado'){

	$tpl->addFile("DADOS", "../pages/cadastrado.html");
	$tpl->NOME = $_SESSION['usuario'];

	if($_GET['tipo'] == "filial") {
		$tpl->block("BLOCK_CADASTRO_FILIAL");
	}
	else if($_GET['tipo'] == "pessoa") {
		$tpl->block("BLOCK_CADASTRO_PESSOA");
	}
	else if($_GET['tipo'] == "oferta") {
		$tpl->block("BLOCK_CADASTRO_OFERTA");
	}
	else if($_GET['tipo'] == "produto") {
		$tpl->block("BLOCK_CADASTRO_PRODUTO");
	}
}
else{

	$projecao = ['_id' => 0];

	$destaque = new Conectar();
	$destaque->setServidor('localhost');
	$destaque->setUserCon('root');
	$destaque->setPwdCon('root');
	$destaque->setBaseCon('admin');
	$destaque->setCon([NULL], $projecao);
	$destaque->setBaseCons('mercado.destaque');
	// print_r($destaque);exit();
	$tpl->addFile("DADOS", "../pages/index.html");

	foreach ($destaque->conecta() as $p) {

		// print_r($p);exit;
	    $tpl->DESCRICAO = $p->descricao;
	    $tpl->OBSERVACAO = $p->observacao;
	    $tpl->ICONE = $p->icone;
	    $tpl->block("BLOCK_DESTAQUE");
    }
}
$tpl->block("BLOCK_DADOS");
$tpl->show();
include_once '../pages/footer.html';
?>
