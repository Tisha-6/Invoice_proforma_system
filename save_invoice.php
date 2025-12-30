<?php
include "includes/db.php";

$type = $_POST['invoice_type'];
$customer = $_POST['customer_name'];
$tax = $_POST['tax'];
$total = $_POST['grand_total'];

$invoice_no = ($type == 'invoice') ? "INV-" . time() : "PRO-" . time();

$conn->query("INSERT INTO invoices 
(invoice_no, invoice_type, customer_name, tax, total) 
VALUES ('$invoice_no','$type','$customer','$tax','$total')");

$invoice_id = $conn->insert_id;

for ($i = 0; $i < count($_POST['item_name']); $i++) {
    $name = $_POST['item_name'][$i];
    $qty = $_POST['qty'][$i];
    $price = $_POST['price'][$i];
    $item_total = $_POST['item_total'][$i];

    $conn->query("INSERT INTO invoice_items 
    (invoice_id, item_name, qty, price, item_total)
    VALUES ('$invoice_id','$name','$qty','$price','$item_total')");
}

header("Location: generate_pdf.php?id=$invoice_id");
?>






































