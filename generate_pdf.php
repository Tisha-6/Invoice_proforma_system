<?php
include "includes/db.php";
require_once("tcpdf/tcpdf.php");

$id = $_GET['id'];

$invoice = $conn->query("SELECT * FROM invoices WHERE id=$id")->fetch_assoc();
$items = $conn->query("SELECT * FROM invoice_items WHERE invoice_id=$id");

$pdf = new TCPDF();
$pdf->AddPage();

$html = "<h2>".strtoupper($invoice['invoice_type'])."</h2>";
$html .= "<p>Invoice No: ".$invoice['invoice_no']."</p>";
$html .= "<p>Customer: ".$invoice['customer_name']."</p>";

$html .= "<table border='1' cellpadding='5'>
<tr><th>Item</th><th>Qty</th><th>Price</th><th>Total</th></tr>";

while ($row = $items->fetch_assoc()) {
    $html .= "<tr>
    <td>{$row['item_name']}</td>
    <td>{$row['qty']}</td>
    <td>{$row['price']}</td>
    <td>{$row['item_total']}</td>
    </tr>";
}

$html .= "</table>";
$html .= "<h4>Total: {$invoice['total']}</h4>";

$pdf->writeHTML($html);
$pdf->Output("invoice.pdf");
