<?php
include_once './conecta.php';
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
/*$insep = new Conectar();
$insep->setServidor('localhost');
$insep->setUserCon('root');
$insep->setPwdCon('root');
$insep->setBaseCon('admin');
$insep->setCon(array('as' => 12));
$insep->setBaseCons('mercado.teste');
// $insep->insere();

// $filter = ['1' => ['$gt' => 1]];
// $options = [
//     'projection' => ['_id' => 0],
//     'sort' => ['x' => -1],
// ];

// $query = new MongoDB\Driver\Query($filter, $options);
// $cursor = $manager->executeQuery('mercado.produtos', $query);
// print_r($cursor);

$connect = new \MongoDB\Driver\Manager("mongodb://localhost:27017/mercado");
$query = new MongoDB\Driver\Query(array('cod_produto' => ['$gt' => 1]););
var_dump($query);*/

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// $bulk = new MongoDB\Driver\BulkWrite;
// $bulk->insert(['x' => 1]);
// $bulk->insert(['x' => 2]);
// $bulk->insert(['x' => 3]);
// $manager->executeBulkWrite('mercado.produtos', $bulk);

$filter = ['prod_codigo' => ['$gt' => 0]];
$options = [
    'projection' => ['_id' => 0]
];

$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery('mercado.produtos', $query);

foreach ($cursor as $document) {
    print_r($document);
}
