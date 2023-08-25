<?php
require_once 'Database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();

    $manufacturerName = $_POST['manufacturerName'];

    require_once 'Manufacturer.php';

    $manufacturer = new Manufacturer();
    $result = $manufacturer->addManufacturer($manufacturerName);

    if ($result) {
        echo "Manufacturer added successfully!";
    } else {
        echo "Error adding manufacturer!";
    }
}
