<?php
if (isset($_POST['id'])) {
    require_once 'config.php';

    $id = $_POST['id'];
    $sql = "DELETE FROM contact_form WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }
        $stmt->close();
    } else {
        echo "error";
    }
    $conn->close();
} else {
    echo "error";
}