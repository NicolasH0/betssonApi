<?php

class Report
{
    private $conn;
    private $table = 'reporting';
    //Reporting table properties
    public $id;
    public $action;
    public $customerId;
    public $countryCode;
    public $amount;
    public $date;
    public $params;
    public $setParam;

    // Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    public function create()
    {
        $query = 'INSERT INTO '.$this->table.'
                  SET '.$this->setParam;
        $stmt = $this->conn->prepare($query);

        if($stmt->execute($this->params)){
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }


    public function findAllByDayInterval($dayInterval = 7): array
    {
        $query = 'SELECT * FROM '.$this->table.' WHERE date BETWEEN date_sub(now(),INTERVAL ? DAY) AND now();';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $dayInterval);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}