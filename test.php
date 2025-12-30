<?php
$conn = new mysqli("localhost", "root", "", "invoice_system");
if ($conn->connect_error) {
    die("Fail: " . $conn->connect_error);
}
echo "Database Connected Successfully";
























