<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$database = "store";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DATE_FORMAT(date, '%a') AS day, product_name, SUM(quantity) AS total_quantity
        FROM order_items
        WHERE date >= DATE(NOW()) - INTERVAL 1 WEEK
        GROUP BY day, product_name
        ORDER BY day, total_quantity DESC";
$result = $conn->query($sql);

$data = array();
$previousDay = "";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($previousDay != $row['day']) {
            $previousDay = $row['day'];
            $data[] = $row;
        }
    }
}

echo json_encode($data);

$conn->close();
?>