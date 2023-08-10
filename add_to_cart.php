// add_to_cart.php
<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['productId'];
    $clientId = $_POST['clientId'];

    $sql = "INSERT INTO cart (product_id, client_id, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $productId, $clientId, $quantity);

    $quantity = 1;

    if ($stmt->execute()) {
        echo "Product added to cart.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>