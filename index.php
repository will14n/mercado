<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

$con = [
                    'cod_filial' => $_POST['filialCodigo'],
                    'nome' => $_POST['filialNome'],
                    'endereco' => $_POST['filialEndereco'],
                    'observacao' => $_POST['filialObservacao']
                ];

$connect = new \MongoDB\Driver\Manager("mongodb://admin:admin@ds023523.mlab.com:23523/mercado");
$bulk = new MongoDB\Driver\BulkWrite;
$doc = $con;
$bulk->insert($doc);
$connect2->executeBulkWrite('admin', $bulk); 

print_r($connect2);
// header("location: ./controller/index.php");