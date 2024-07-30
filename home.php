<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Invoice Entery</h1>
        <form action="submit_invoice.php" method="post">
            <div class="mb-3">
                <label class="form-label">Customer Name</label>
                <input type="text" name="customer_name" class="form-control" placeholder="Enter customer name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Company Name</label>
                <input type="text" name="company_name" class="form-control" placeholder="Enter company name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" placeholder="Enter phone number" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div id="product-container">
                <div class="product-item">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="product_name[]" class="form-control" placeholder="Enter product name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Quantity</label>
                        <input type="number" name="quantity[]" class="form-control" placeholder="Enter quantity" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="text" name="amount[]" class="form-control" placeholder="Enter amount" required>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" id="add-product">Add Another Product</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <a href="view_invoices.php" class="btn btn-secondary mt-3">View Invoices</a>
    </div>

    <script>
        document.getElementById('add-product').addEventListener('click', function() {
            var container = document.getElementById('product-container');
            var newProduct = container.children[0].cloneNode(true);
            var inputs = newProduct.getElementsByTagName('input');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].value = '';
            }
            container.appendChild(newProduct);
        });
    </script>
</body>
</html>
