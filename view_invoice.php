<?php
// view_invoice.php

$host = "localhost";
$user = "root";
$pass = "";
$db = "invoice_system";

// Connect to database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch invoices with their items
$invoices = $conn->query("SELECT * FROM invoices ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Invoices</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

<h3>All Invoices / Proforma</h3>

<a href="create_invoice.php" class="btn btn-success mb-3">Create New Invoice</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Invoice No</th>
            <th>Type</th>
            <th>Customer</th>
            <th>Items</th>
            <th>Subtotal</th>
            <th>Tax</th>
            <th>Total</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php if($invoices->num_rows > 0): ?>
            <?php while($inv = $invoices->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $inv['id']; ?></td>
                    <td><?php echo $inv['invoice_no']; ?></td>
                    <td><?php echo ucfirst($inv['invoice_type']); ?></td>
                    <td><?php echo $inv['customer_name']; ?></td>
                    <td>
                        <ul>
                        <?php
                        $items = $conn->query("SELECT * FROM invoice_items WHERE invoice_id=".$inv['id']);
                        while($item = $items->fetch_assoc()){
                            echo "<li>".$item['item_name']." — Qty: ".$item['qty']." x Price: ".$item['price']." = ".$item['item_total']."</li>";
                        }
                        ?>
                        </ul>
                    </td>
                    <td><?php echo $inv['subtotal']; ?></td>
                    <td><?php echo $inv['tax']; ?></td>
                    <td><?php echo $inv['total']; ?></td>
                    <td><?php echo $inv['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="9">No invoices found</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
