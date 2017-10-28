<?php
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);
// include_once '../classes/conecta.php'; #CLASSE DE CONEXAO LOCAL
include '../classes/produto.php';
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
			else if($_POST['filial']) {

				$con = [
					'cod_filial' => $_POST['filialCodigo'],
					'nome' => $_POST['filialNome'],
					'endereco' => $_POST['filialEndereco'],
					'observacao' => $_POST['filialObservacao']
				];

				$cadastrar = new Conectar();
				$cadastrar->setBaseCon('admin');
				$cadastrar->setCon($con);
				$cadastrar->setBaseCons('mercado.filiais');
				$cadastrar->insere();

				header('location: ./index.php?page=cadastrado&tipo=filial');
				exit;
			}
			else if($_POST['oferta']) {

				$con = [
					'src' => $_POST['ofertaCaminho'],
					'descricao' => $_POST['ofertaDescricao']
				];

				/*$oferta = new Oferta();
				$oferta->set*/

				$cadastrar = new Conectar();
				$cadastrar->setBaseCon('admin');
				$cadastrar->setCon($con);
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

				/*$cadastrar = new Conectar();
				$cadastrar->setBaseCon('admin');
				$cadastrar->setCon($con);
				$cadastrar->setBaseCons('mercado.promocao');
				$cadastrar->insere();*/

				header('location: ./index.php?page=cadastrado&tipo=produto');
				exit();
			}
		}
		else {
			$tpl->addFile("DADOS", "../pages/login.html");
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
