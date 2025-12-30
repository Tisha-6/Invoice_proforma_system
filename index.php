<?php
// db connection
$conn = new mysqli("localhost", "root", "", "invoice_system");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// fetch invoices
$sql = "SELECT * FROM invoices ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Invoice List</h2>
        <a href="create_invoice.php" class="btn btn-primary">+ Create Invoice</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Invoice No</th>
                <th>Type</th>
                <th>Customer</th>
                <th>Subtotal</th>
                <th>Tax</th>
                <th>Total</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row['invoice_no']; ?></td>
                    <td>
                        <span class="badge bg-<?= $row['invoice_type'] == 'invoice' ? 'success' : 'warning'; ?>">
                            <?= ucfirst($row['invoice_type']); ?>
                        </span>
                    </td>
                    <td><?= $row['customer_name']; ?></td>
                    <td><?= number_format($row['subtotal'], 2); ?></td>
                    <td><?= number_format($row['tax'], 2); ?></td>
                    <td><strong><?= number_format($row['total'], 2); ?></strong></td>
                    <td><?= date("d-m-Y", strtotime($row['created_at'])); ?></td>
                    <td>
                        <a href="view_invoice.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-info">View</a>
                        <a href="delete_invoice.php?id=<?= $row['id']; ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this invoice?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="9" class="text-center">No invoices found</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
