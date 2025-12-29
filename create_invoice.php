<!DOCTYPE html>
<html>
<head>
    <title>Create Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

<h3>Create Invoice / Proforma</h3>

<form action="save_invoice.php" method="post">
    <div class="mb-2">
        <label>Invoice Type</label>
        <select name="invoice_type" class="form-control">
            <option value="invoice">Invoice</option>
            <option value="proforma">Proforma Invoice</option>
        </select>
    </div>

    <div class="mb-2">
        <label>Customer Name</label>
        <input type="text" name="customer_name" class="form-control" required>
    </div>

    <table class="table" id="items">
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
            <th></th>
        </tr>
        <tr>
            <td><input name="item_name[]" class="form-control"></td>
            <td><input name="qty[]" class="form-control qty"></td>
            <td><input name="price[]" class="form-control price"></td>
            <td><input name="item_total[]" class="form-control total" readonly></td>
            <td><button type="button" class="btn btn-danger remove">X</button></td>
        </tr>
    </table>

    <button type="button" id="add" class="btn btn-secondary">Add Item</button>

    <div class="mt-3">
        <label>Tax (%)</label>
        <input type="number" name="tax" id="tax" class="form-control" value="0">
    </div>

    <div class="mt-2">
        <label>Grand Total</label>
        <input type="text" name="grand_total" id="grand_total" class="form-control" readonly>
    </div>

    <button class="btn btn-primary mt-3">Save Invoice</button>
</form>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
function calculate() {
    let subtotal = 0;
    $(".total").each(function () {
        subtotal += Number($(this).val());
    });
    let tax = $("#tax").val();
    let grand = subtotal + (subtotal * tax / 100);
    $("#grand_total").val(grand.toFixed(2));
}

$(document).on("keyup", ".qty,.price", function () {
    let row = $(this).closest("tr");
    let qty = row.find(".qty").val();
    let price = row.find(".price").val();
    let total = qty * price;
    row.find(".total").val(total);
    calculate();
});

$("#add").click(function () {
    $("#items").append($("#items tr:eq(1)").clone());
});

$(document).on("click", ".remove", function () {
    $(this).closest("tr").remove();
    calculate();
});
</script>
</body>
</html>
