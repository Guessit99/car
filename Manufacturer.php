<?php
require_once 'Database.php';
class Manufacturer
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addManufacturer($manufacturerName)
    {
        // $manufacturerName = $this->db->conn->real_escape_string($manufacturerName);



        $query = "INSERT INTO manufacturers (name) VALUES ('$manufacturerName')";
        $result = $this->db->executeQuery($query);

        return $result;
    }

    public function getManufacturers()
    {
        $query = "SELECT * FROM manufacturers";
        $result = $this->db->executeQuery($query);

        $manufacturers = array();
        while ($row = $result->fetch_assoc()) {
            $manufacturers[] = $row;
        }

        return $manufacturers;
    }
}
