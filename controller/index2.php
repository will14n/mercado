<?php
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);
include_once '../classes/conecta.php';
require_once("../lib/raelgc/view/Template.php");
use raelgc\view\Template;

$tpl = new Template("../pages/nav.html");

if($_SESSION['autentica'] == "true") {
	$tpl->ACESSO = "../controller/index.php?page=login";
}
else {
	$tpl->ACESSO = "#";
	$tpl->DROPDOWN = "dropdown";	
}
$tpl = new Template("../pages/dados.html");
$tpl->addFile("DADOS", "../pages/cadastros.html");
$tpl->block("BLOCK_CADASTRO_CLIENTE");
$tpl->block("BLOCK_DADOS");
$tpl->show();

$cadastrar = new Conectar();
$cadastrar->setServidor('localhost');
$cadastrar->setUserCon('root');
$cadastrar->setPwdCon('root');
$cadastrar->setBaseCon('admin');
$cadastrar->setCon($con);
$cadastrar->setBaseCons('mercado.promocao');
$cadastrar->insere();

?>