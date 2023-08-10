<?php
require_once 'config.php';

$maxPrice = isset($_GET['maxPrice']) ? intval($_GET['maxPrice']) : 2000;

$sql = "SELECT id, name, image, price FROM products WHERE price <= ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $maxPrice);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="col mb-4">';
        echo '<div class="card product-card h-100">';
        echo '<img src="admin-page/img/' . $row["image"] . '" class="card-img-top" alt="' . $row["name"] . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row["name"] . '</h5>';
        echo '<p class="card-text">$' . $row["price"] . '</p>';
        echo '</div>';
        echo "<button class='add-to-cart' data-product-id='" . $row["id"] . "'>Add to cart</button>";
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No products found within the selected price range.";
}

$stmt->close();
$conn->close();
?>