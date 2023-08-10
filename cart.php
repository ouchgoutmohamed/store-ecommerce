<!-- cart.php -->
<?php require_once('config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Add Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
     
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}
    </style>
</head>
<body>
<?php include 'header.html' ?>
<div class="container">
        <h2 class="my-4">Your Cart:</h2>
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $clientId =1;
                $sql = "SELECT p.id, p.name, p.price, c.quantity FROM cart c JOIN products p ON c.product_id = p.id WHERE c.client_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $clientId);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>$" . $row["price"] . "</td>";
                        echo "<td><input type='number' class='form-control quantity' min='1' value='" . $row["quantity"] . "' data-product-id='" . $row["id"] . "'></td>";
                        echo "<td class='total'>$" . ($row["price"] * $row["quantity"]) . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-primary btn-sm update mr-2' data-product-id='" . $row["id"] . "'>Update</button>";
                        echo "<button class='btn btn-danger btn-sm remove' data-product-id='" . $row["id"] . "'>Remove</button>";
                        echo "</td>";
                        echo "<tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Your cart is empty.</td></tr>";
                }

                $stmt->close();
                ?>
            </tbody>
        </table>

        <h3 class="my-4">Total: <span id="cart-total"></span></h3>
        <a href="checkout.php"><button class='btn btn-primary  '>confirm</button></a>
    </div>
    
    <script >
        // cart.js
// cart.js

 $(document).ready(function() {
    $('.update').on('click', updateCart);
    $('.remove').on('click', removeFromCart);
    calculateTotal();
});

function updateCart(event) {
    const productId = $(event.target).data('productId');
    const newQuantity = $(event.target).closest('tr').find('.quantity').val();
    const clientId = 1;

    $.post('update_cart.php', {
        productId: productId,
        action: 'update',
        clientId: clientId,
        quantity: newQuantity
    }, function() {
        // Reload the page to refresh cart data
        location.reload();
    });
}

// cart.js
function removeFromCart(event) {
    const productId = $(event.target).data('productId');
    const clientId = 1;

    $.post('update_cart.php', {
        productId: productId,
        action: 'remove',
        clientId: clientId
    }, function() {
        $(event.target).closest('tr').remove();
        calculateTotal();
        location.reload();
    });
}

function calculateTotal() {
    let total = 0;
    $('.total').each(function() {
        const price = parseFloat($(this).text().replace('$', ''));
        total+= price;
    });

    $('#cart-total').text('$' + total.toFixed(2));
}
    </script>
    <?php include 'footer.php' ?>
</body>
</html>