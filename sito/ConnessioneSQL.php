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

    public function select($table, $fields = '*', $other = '')
    {
        $fields = is_array($fields) ? implode(', ', $fields) : $fields;

        $results = $this->query("SELECT {$fields} FROM {$table} {$other}");

        return $results->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($table, $values = [])
    {
        $keys = implode(',', array_keys($values));

        $values = array_map(function ($value) {
            return "'" . $this->conn->real_escape_string($value) . "'";
        }, $values);

        $values = implode(",", $values);

        $results = $this->query("INSERT INTO $table ($keys) VALUES ($values)");
        return $results ? $this->conn->insert_id : false;
    }

    public function update($table, $values = [], $where = [])
    {
        $values = array_map(function ($value, $key) {
            return $key . "=" . "'" . $this->conn->real_escape_string($value) . "'";
        }, $values, array_keys($values));

        $values = implode(',', $values);

        $where = array_map(function ($value, $key) {
            return $key . "=" . "'" . $this->conn->real_escape_string($value) . "'";
        }, $where, array_keys($where));

        $where = implode('and ', $where);

        return $this->query("UPDATE $table SET $values WHERE $where");
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
