<?php
include 'Database.php';
class Model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addModel($manufacturerId, $modelName, $color, $year, $registrationNumber, $note, $imageUrls)
    {
        $modelName = $this->db->conn->real_escape_string($modelName);
        $color = $this->db->conn->real_escape_string($color);
        $year = $this->db->conn->real_escape_string($year);
        $registrationNumber = $this->db->conn->real_escape_string($registrationNumber);
        $note = $this->db->conn->real_escape_string($note);
        $imageUrlsSerialized = serialize($imageUrls);
    
        $query = "INSERT INTO models (manufacturer_id, name, color, manufacturing_year, registration_number, note, image)
        VALUES ('$manufacturerId', '$modelName', '$color', '$year', '$registrationNumber', '$note', '$imageUrlsSerialized')";
        $result = $this->db->executeQuery($query);
        $modelId = $this->db->getLastInsertId();

        // Insert image URLs
        foreach ($imageUrls as $imageUrl) {
            $imageUrl = $this->db->conn->real_escape_string($imageUrl);
            // $query = "INSERT INTO model_image (model_id, image_url) VALUES ('$modelId', '$imageUrl')";
            $this->db->executeQuery($query);
        }


        return $result;
    }

    public function getModels()
    {
        $query = "SELECT models.*, manufacturers.name AS manufacturer_name 
                  FROM models 
                  INNER JOIN manufacturers ON models.manufacturer_id = manufacturers.id";
        $result = $this->db->executeQuery($query);

        $models = array();
        while ($row = $result->fetch_assoc()) {
            $models[] = $row;
        }

        return $models;
    }

    public function getModelDetails($modelId)
    {
        $query = "SELECT * FROM models WHERE id = '$modelId'";
        $result = $this->db->executeQuery($query);
        $model = $result->fetch_assoc();

        $query = "SELECT image_url FROM model_image WHERE model_id = '$modelId'";
        $result = $this->db->executeQuery($query);

        $imageUrls = array();
        while ($row = $result->fetch_assoc()) {
            $imageUrls[] = $row['image_url'];
        }

        $model['image_urls'] = $imageUrls;

        return $model;
    }

    public function deleteModel($modelId)
    {
        $query = "DELETE FROM models WHERE id = '$modelId'";
        $result = $this->db->executeQuery($query);

        // Also delete associated image URLs
        $query = "DELETE FROM model_image WHERE model_id = '$modelId'";
        $this->db->executeQuery($query);

        return $result;
    }
}
    