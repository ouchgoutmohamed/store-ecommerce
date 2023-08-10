<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $productId = $_POST['productId'];
    $clientId = $_POST['clientId']; // Add this line

    if ($action == 'update') {
        $quantity = $_POST['quantity'];
        $sql = "UPDATE cart SET quantity = ? WHERE product_id = ? AND client_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $quantity, $productId, $clientId);

        if ($stmt->execute()) {
            echo "Cart updated.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($action == 'remove') {
        $sql = "DELETE FROM cart WHERE product_id = ? AND client_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $productId, $clientId);

        if ($stmt->execute()) {
            echo "Product removed from cart.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>