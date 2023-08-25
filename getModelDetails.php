<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $modelId = $_GET['modelId'];

    require_once 'Model.php';

    $model = new Model();
    $modelDetails = $model->getModelDetails($modelId);

    echo json_encode($modelDetails);
}
