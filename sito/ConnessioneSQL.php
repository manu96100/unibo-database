<?php

class ConnessioneSQL
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "progetto_database";

    private $conn;

    public function __construct()
    {
        // Create connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}