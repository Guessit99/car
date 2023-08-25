<!DOCTYPE html>
<html>
<head>
    <title>Add Model</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        .centeralign {
        text-align: center;
    }

    .gallery {
        border: 1px solid black;
        margin-top: 100px;
        margin-bottom: 100px;
        margin-right: 100px;
        margin-left: 100px;
        background-color: lightblue;
    }
    </style>
</head>
<body>
    <div class="centeralign gallery">
        <h1>Add Model</h1>
    <form id="addModelForm">
        <label for="manufacturerId">Manufacturer:</label>
        <select id="manufacturerId" name="manufacturerId">
            <?php
            require_once 'Manufacturer.php';

            $manufacturer = new Manufacturer();
            $manufacturers = $manufacturer->getManufacturers();

            foreach ($manufacturers as $manufacturer) {
                echo "<option value='" . $manufacturer['id'] . "'>" . $manufacturer['name'] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="modelName">Model Name:</label>
        <input type="text" class="form-control" id="modelName" name="modelName">
        <br><br>
        <label for="color">Color:</label>
        <input type="text" class="form-control"  id="color" name="color">
        <br><br>
        <label for="year">Manufacturing Year:</label>
        <input type="text" class="form-control" id="year" name="year">
        <br><br>
        <label for="registrationNumber">Registration Number:</label>
        <input type="text" class="form-control" id="registrationNumber" name="registrationNumber">
        <br><br>
        <label for="note">Note:</label>
        <input type="text" class="form-control" id="note" name="note">
        <br><br>
        <label for="imageUrls">Image:</label>
        <input type="file" class="form-control"  id="imageUrls" name="imageUrls[]" multiple>
        <br><br>
        <button type="submit" class="btn btn-info">Submit</button>
    </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
  function myFunction() {
    window.location.href="http://programminghead.com";
  }
 </script>
    <script>
        $(document).ready(function() {
            $('#addModelForm').submit(function(e) {
                e.preventDefault();
                var manufacturerId = $('#manufacturerId').val();
                var modelName = $('#modelName').val();
                var color = $('#color').val();
                var year = $('#year').val();
                var registrationNumber = $('#registrationNumber').val();
                var note = $('#note').val();
                var imageUrls = $('#imageUrls')[0].files;
               

                var formData = new FormData();
                formData.append('manufacturerId', manufacturerId);
                formData.append('modelName', modelName);
                formData.append('color', color);
                formData.append('year', year);
                formData.append('registrationNumber', registrationNumber);
                formData.append('note', note);
                for (var i = 0; i < imageUrls.length; i++) {
                    formData.append('imageUrls[]', imageUrls[i]);
                }

                $.ajax({
                    url: 'addModel.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response);
                    }
                });
            });
        });
    </script>
</body>
</html>
