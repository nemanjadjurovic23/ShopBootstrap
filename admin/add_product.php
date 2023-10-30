<?php 

require_once '../app/config/config.php';
require_once '../app/classes/User.php';
require_once '../app/classes/Product.php';

$user = new User();

// ne radi
if ($user->is_logged() && $user->is_admin()) : 
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product = new Product();

        $name = $_POST['name'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        $image = $_POST['photo_path'];

        $product->create($name, $price, $size, $image);

        header('location: index.php');
    }

endif;

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>


<form action="add_product.php" method="post">
    <input type="text" name="name" placeholder="Product Name">
    <input type="text" price="price" step="0.01" placeholder="Product Price">
    <input type="text" name="size" placeholder="Product Size">
    <input type="text" name="photo_path" id="photoPathInput">
    <div class="dropzone" id="dropzone-upload"></div>
    <input type="submit" value="Add Product">
</form>

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<script>
    Dropzone.options.dropzoneUpload = {
        url: "upload_photo.php",
                paramName: "photo",
                maxFilesize: 20, // MB
                acceptedFiles: "image/*",
                init: function() { 
                    this.on("success", function(file, response) {
                        // Parse the JSON response
                        const jsonResponse = JSON.parse(response);
                        // Check if the file was uploaded successfully
                        if (jsonResponse.success) {
                            // Set the hidden input's value to the uploaded file's path
                            document.getElementById('photoPathInput').value = jsonResponse.photo_path;
                        } else {
                            console.error(jsonResponse.error);
                        }
                });
            }
        };
</script>