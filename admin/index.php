<?php

    require '../app/config/config.php';
    require '../app/classes/User.php';
    require_once '../app/classes/Product.php';

    $user = new User();

    if ($user->is_logged() && $user->is_admin()) : 
    
    $products = new Product();
    $products = $products->fetch_all();
    ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Admin</title>
        </head>
        <body>

            <div class="container">

                <a href="add_product.php" class="btn btn-success">Add Product</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Product ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Size</th>
                            <th scope="col">Image</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $product) : ?>
                            <tr>
                                <th scope="row"><?php echo $product['product_id']; ?></th>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td><?php echo $product['size']; ?></td>
                                <td><?php echo $product['image']; ?></td>
                                <td><?php echo $product['created_at']; ?></td>
                                <td>
                                    <a href="edit_product.php?id=<?php echo $product['product_id']; ?>" class="btn btn-primary">Edit</a>
                                    <a href="delete_product.php?id=<?php echo $product['product_id']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        </body>
        </html>

    <?php endif; ?>