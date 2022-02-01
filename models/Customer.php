<?php

class Customer
{
    private $conn;
    private $table = 'customers';
    //Customers table properties
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $gender;
    public $countryCode;
    public $bonusPercent;
    public $balance;
    public $bonusBalance;
    public $depositCounter;
    public $params;
    public $setParam;

    // Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        // Select QUERY to read all data
        $query = "SELECT
                   *
                  FROM $this->table";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_single()
    {
        $query = 'SELECT * FROM '.$this->table.' WHERE id = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        // return $stmt;

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row !== false) {
            $this->firstName = $row['firstName'];
            $this->lastName = $row['lastName'];
            $this->email = $row['email'];
            $this->id = $row['id'];
            $this->bonusPercent = $row['bonusPercent'];
            $this->gender = $row['gender'];
            $this->countryCode = $row['countryCode'];
            $this->balance = $row['balance'];
            $this->bonusBalance = $row['bonusBalance'];
            $this->depositCounter = $row['depositCounter'];
        } else {
            die('Customer not found');
        }
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

    public function update()
    {
        $query = 'UPDATE '.$this->table.'
                  SET '.$this->setParam.'
                  WHERE id = '.$this->id;

        $stmt = $this->conn->prepare($query);


        if($stmt->execute($this->params)){
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function findByEmail($email)
    {
        $query = 'SELECT * FROM '.$this->table.' WHERE email = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $email);

        $stmt->execute();

        // return $stmt;

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->firstName = $row['firstName'] ?? '';
        $this->lastName = $row['lastName'] ?? '';
        $this->email = $row['email'] ?? '';
        $this->id = $row['id'] ?? '';
        $this->bonusPercent = $row['bonusPercent'] ?? '';
        $this->gender = $row['gender'] ?? '';
        $this->countryCode = $row['countryCode'] ?? '';
        $this->balance = $row['balance'] ?? '';
        $this->bonusBalance = $row['bonusBalance'] ?? '';
        $this->depositCounter = $row['depositCounter'] ?? '';
    }
}