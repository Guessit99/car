<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Inventory</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
</head>

<body>

<a href="http://localhost/car/manufacturer.html">Add Manufacturer</a><br>
<a href="http://localhost/car/model1.php">Add Model</a>
    <table id="inventoryTable">
        <thead>
            <tr>
                <th>Serial Number</th>
                <th>Manufacturer Name</th>
                <th>Model Name</th>
                <th>Action</th>
            
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'Model.php';

            $model = new Model();
            $models = $model->getModels();

            $serialNumber = 1;
            foreach ($models as $model) {
                echo "<tr data-model-id='" . $model['id'] . "'>";
                echo "<td>" . $serialNumber . "</td>";
                echo "<td>" . $model['manufacturer_name'] . "</td>";
                echo "<td>" . $model['name'] . "</td>";
                echo "</tr>";
                $serialNumber++;
            }
            ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#inventoryTable').DataTable();

            $('tbody tr').click(function() {
                var modelId = $(this).data('model-id');

                $.ajax({
                    url: 'getModelDetails.php',
                    type: 'GET',
                    data: {
                        modelId: modelId
                    },
                    success: function(response) {
                        var modelDetails = JSON.parse(response);
                        // Display popup with model details
                        console.log(modelDetails);
                    }
                });
            });
        });
    </script>
</body>

</html>