<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $manufacturerId = $_POST['manufacturerId'];
    $modelName = $_POST['modelName'];
    $color = $_POST['color'];
    $year = $_POST['year'];
    $registrationNumber = $_POST['registrationNumber'];
    $note = $_POST['note'];
    $imageUrls = array();

    // Upload images and get their URLs
    if (isset($_FILES['imageUrls']) && !empty($_FILES['imageUrls']['name'][0])) {
        $totalFiles = count($_FILES['imageUrls']['name']);
        for ($i = 0; $i < $totalFiles; $i++) {
            $tmpFilePath = $_FILES['imageUrls']['tmp_name'][$i];
            if ($tmpFilePath != "") {
                $newFilePath = "uploads/" . $_FILES['imageUrls']['name'][$i];
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $imageUrls[] = $newFilePath;
                }
            }
        }
    }

    require_once 'Model.php';

    $model = new Model();
    $result = $model->addModel($manufacturerId, $modelName, $color, $year, $registrationNumber, $note, $imageUrls);

    if ($result) {
        
        echo "Model added successfully!";
    } else {
        echo "Error adding model!";
    }
}
