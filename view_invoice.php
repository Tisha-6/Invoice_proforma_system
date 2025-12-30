<?php
// demo data (later you can replace with database data)
$invoice_no = "INV-001";
$date = date("d-m-Y");
$customer = "John Doe";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice <?= $invoice_no ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-box {
            width: 800px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        .no-border {
            border: none;
        }
        .right {
            text-align: right;
        }
        .print-btn {
            margin: 20px;
            text-align: center;
        }

        /* Hide button when printing */
        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="print-btn">
    <button onclick="window.print()">🖨️ Print / Save as PDF</button>
</div>

<div class="invoice-box">
    <table class="no-border">
        <tr class="no-border">
            <td class="no-border">
                <h2>ABC COMPANY</h2>
                Address: City, Country<br>
                Email: abc@email.com
            </td>
            <td class="no-border right">
                <h3>INVOICE</h3>
                Invoice No: <?= $invoice_no ?><br>
                Date: <?= $date ?>
            </td>
        </tr>
    </table>

    <br>

    <table>
        <tr>
            <td><strong>Bill To</strong></td>
            <td><?= $customer ?></td>
        </tr>
    </table>

    <br>

    <table>
        <tr>
            <th>#</th>
            <th>Description</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Website Development</td>
            <td>2</td>
            <td>250.00</td>
            <td>500.00</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Hosting</td>
            <td>1</td>
            <td>100.00</td>
            <td>100.00</td>
        </tr>
        <tr>
            <td colspan="4" class="right"><strong>Subtotal</strong></td>
            <td>600.00</td>
        </tr>
        <tr>
            <td colspan="4" class="right"><strong>Tax</strong></td>
            <td>60.00</td>
        </tr>
        <tr>
            <td colspan="4" class="right"><strong>Total</strong></td>
            <td><strong>660.00</strong></td>
        </tr>
    </table>

    <br>
    <p><strong>Note:</strong> Thank you for your business.</p>
</div>

</body>
</html>
