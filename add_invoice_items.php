<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoice_id = $_POST['invoice_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $amount = $_POST['amount'];

    // Sanitize and validate input
    $invoice_id = mysqli_real_escape_string($conn, $invoice_id);
    $product_id = mysqli_real_escape_string($conn, $product_id);
    $quantity = mysqli_real_escape_string($conn, $quantity);
    $amount = mysqli_real_escape_string($conn, $amount);

    $sql = "INSERT INTO invoice_items (invoice_id, product_id, quantity, amount) VALUES ('$invoice_id', '$product_id', '$quantity', '$amount')";

    if (mysqli_query($conn, $sql)) {
        echo "Invoice item added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Invoice Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container my-5">
        <h1>Add Invoice Item</h1>
        <form action="add_invoice_items.php" method="post">
            <div class="mb-3">
                <label class="form-label">Invoice ID</label>
                <input type="number" name="invoice_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product ID</label>
                <input type="number" name="product_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Amount</label>
                <input type="text" name="amount" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
