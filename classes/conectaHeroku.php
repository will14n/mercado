<?php

class Conectar{
    public $servidor;
    public $userCon;
    public $pwdCon;
    public $baseCon;
    public $con;
    public $baseCons;
            
    function getServidor() {
        return $this->servidor;
    }

    function getUserCon() {
        return $this->userCon;
    }

    function getPwdCon() {
        return $this->pwdCon;
    }

    function getBaseCon() {
        return $this->baseCon;
    }
    
    function getCon(){
        return $this->con;
    }
    
    function getBaseCons(){
        return $this->baseCons;
    }
            
    function setServidor($servidor) {
        $this->servidor = $servidor;
    }

    function setUserCon($userCon) {
        $this->userCon = $userCon;
    }

    function setPwdCon($pwdCon) {
        $this->pwdCon = $pwdCon;
    }

    function setBaseCon($baseCon) {
        $this->baseCon = $baseCon;
    }
    
    function setCon($con){
        $this->con = $con;
    }
    
    function setBaseCons($baseCons){
        $this->baseCons = $baseCons;
    }
            
    
    function conecta(){
        // $connect = new \MongoDB\Driver\Manager("mongodb://$this->userCon:$this->pwdCon@$this->servidor:27017/$this->baseCon");
        // $connect = new \MongoDB\Driver\Manager("mongodb://$this->servidor:27017/$this->baseCon");
        $connect = new \MongoDB\Driver\Manager("mongodb://admin:admin@ds023523.mlab.com:23523/mercado");
        $query = new MongoDB\Driver\Query($this->con);
        $rows = $connect->executeQuery($this->baseCons, $query);
        return $rows;
    }

    function insere(){
        // $connect = new \MongoDB\Driver\Manager("mongodb://admin:admin@ds023523.mlab.com:23523/heroku_b31jlb5p");
        $connect = new \MongoDB\Driver\Manager("mongodb://admin:admin@ds023523.mlab.com:23523/mercado");
        $bulk = new MongoDB\Driver\BulkWrite;
        $doc = $this->con;
        $bulk->insert($doc);
        $connect->executeBulkWrite($this->baseCons, $bulk);
        print_r($connect);
        return "OK!!!";   
    }
}
