<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Invoices</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Invoices</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Customer Name</th>
                    <th>Company Name</th>
                    <th>Phone Number</th>
                    <th>Date</th>
                    <th>Products</th>
                    <th>Quantities</th>
                    <th>Amounts</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connection.php';

                $sql = "SELECT invoicetb.id, customer_name, company_name, phone_number, date,
                               GROUP_CONCAT(product_name SEPARATOR ', ') as products,
                               GROUP_CONCAT(quantity SEPARATOR ', ') as quantities,
                               GROUP_CONCAT(amount SEPARATOR ', ') as amounts
                        FROM invoicetb
                        JOIN invoice_items ON invoicetb.id = invoice_items.invoice_id
                        JOIN products ON invoice_items.product_id = products.id
                        GROUP BY invoicetb.id";
                $result = $mysqli->query($sql);

                while ($row = $result->fetch_assoc()) :
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['company_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['products']); ?></td>
                    <td><?php echo htmlspecialchars($row['quantities']); ?></td>
                    <td><?php echo htmlspecialchars($row['amounts']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="home.php" class="btn btn-secondary mt-3">Back</a>
    </div>
</body>
</html>
