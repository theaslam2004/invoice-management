<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $company_name = $_POST['company_name'];
    $phone_number = $_POST['phone_number'];
    $date = $_POST['date'];
    $product_names = $_POST['product_name'];
    $quantities = $_POST['quantity'];
    $amounts = $_POST['amount'];

    // Insert into invoicetb
    $sql = "INSERT INTO invoicetb (customer_name, company_name, phone_number, date) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssss", $customer_name, $company_name, $phone_number, $date);
    $stmt->execute();
    $invoice_id = $stmt->insert_id;

    // Insert each product and corresponding details into products and invoice_items
    for ($i = 0; $i < count($product_names); $i++) {
        $product_name = $product_names[$i];
        $quantity = $quantities[$i];
        $amount = $amounts[$i];

        // Insert into products
        $sql = "INSERT INTO products (product_name, unit) VALUES (?, 'unit')";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $product_name);
        $stmt->execute();
        $product_id = $stmt->insert_id;

        // Insert into invoice_items
        $sql = "INSERT INTO invoice_items (invoice_id, product_id, quantity, amount) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iiid", $invoice_id, $product_id, $quantity, $amount);
        $stmt->execute();
    }

    if ($stmt->affected_rows > 0) {
        header("Location: view_invoices.php");
        exit();
    } else {
        echo "Error: " . $mysqli->error;
    }
}
?>
