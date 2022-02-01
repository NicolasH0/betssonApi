<?php

class Database
{
    private $conn;
    private $host = "localhost";
    private $name = "root";
    private $pass = "";
    private $db = "betssonapi";

    // DB connection
    public function connection(){

        $this->conn = null;

        try{
            $this->conn = new PDO('mysql:host='. $this->host .';dbname='.$this->db, $this->name, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo 'Error while trying to connect to database: '. $e->getMessage() ;
        }

        return $this->conn;
    }

}