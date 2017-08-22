<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$connect = new \MongoDB\Driver\Manager("mongodb://admin:admin@ds023523.mlab.com:23523/mercado");
print_r($connect);
// header("location: ./controller/index.php");