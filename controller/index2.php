<?php
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);
include_once '../classes/conectaHeroku.php';
include_once '../classes/conecta.php';
require_once("../lib/raelgc/view/Template.php");
use raelgc\view\Template;
// use lib\mongo-php-adapter-master\lib;
// require_once("../lib/mongo-php-adapter-master/lib/Mongo/MongoClient.php");
// require('../vendor/autoload.php');

$filiais = new Conectar();
$filiais->setServidor('localhost');
$filiais->setUserCon('root');
$filiais->setPwdCon('root');
$filiais->setBaseCon('admin');
$filiais->setCon([NULL], $projecao);
$filiais->setBaseCons('mercado.filiais');
$filiais->conecta();
print_r($filiais);
/*
$tpl = new Template("../pages/dados.html");
$tpl->addFile("DADOS", "../pages/cadastros.html");
$tpl->block("BLOCK_CADASTRO_CLIENTE");
$tpl->block("BLOCK_DADOS");
$tpl->show();
$mongo_url = parse_url(getenv("MONGODB_URI"));
print_r($mongo_url);*/
// $cadastrar = new Conectar();
/*$cadastrar->setServidor('localhost');
$cadastrar->setUserCon('root');
$cadastrar->setPwdCon('root');
$cadastrar->setBaseCon('admin');
$cadastrar->setBaseCons('mercado.promocao');
$cadastrar->conecta();
print_r($cadastrar);
$cadastrar->insere();
// print_r($cadastrar);
*/
?>