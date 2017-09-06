<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
include_once './classes/conectaHeroku.php';
/*
$con = [
                    'cod_filial' => 'filialCodigo',
                    'nome' => 'filialNome',
                    'endereco' => 'filialEndereco',
                    'observacao' => 'filialObservacao'
                ];

$cadastrar = new Conectar();
$cadastrar->setServidor('localhost');
$cadastrar->setUserCon('root');
$cadastrar->setPwdCon('root');
$cadastrar->setBaseCon('admin');
$cadastrar->setCon($con);
$cadastrar->setBaseCons('mercado.filiais');
$cadastrar->insere();*/

$bulk = new MongoDB\Driver\BulkWrite(['ordered' => true]);
$bulk->insert(['_id' => 1, 'x' => 1]);

print_r($bulk);
print_r($cadastrar);
// header("location: ./controller/index.php");