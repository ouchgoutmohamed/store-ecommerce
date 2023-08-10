<?php
// update_status.php

// Include the necessary files
require_once 'config.php';

// Function to update the order status in the database
function updateOrderStatus($id, $status) {
    global $conn;

    $sql = "UPDATE orders SET status = '$status' WHERE id = '$id'";
    return $conn->query($sql);
}

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['status'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];

        // Update the order status
        $result = updateOrderStatus($id, $status);

        // Return the response as JSON
        if ($result) {
            echo json_encode(array("statusCode" => 200, "message" => "Order status updated successfully"));
        } else {
            echo json_encode(array("statusCode" => 201, "message" => "Order status update failed"));
        }
    }
}
?>
