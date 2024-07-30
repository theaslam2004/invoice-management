<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $units = $_POST['units'];

    // Sanitize and validate input
    $product_name = $mysqli->real_escape_string($product_name);
    $units = $mysqli->real_escape_string($units);

    $sql = "INSERT INTO products (product_name, unit) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $product_name, $units);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $mysqli->error;
    }
    
    $stmt->close();
    $mysqli->close();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container my-5">
        <h1>Add New Product</h1>
        <form action="add_product.php" method="post">
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="product_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Units</label>
                <input type="text" name="units" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</body>
</html>
