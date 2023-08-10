<?php
// Check if the form is submitted
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['phone'])) {
  // Get the form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $shipping = $_POST['shipping'];

  $servername = "localhost";
$username = "root";
$password = "";
$database = "store";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  // Get the products in cart from the database
  $sql = "SELECT p.id, p.name, p.price, c.quantity
  FROM products p
  JOIN cart c ON p.id = c.product_id ";
  $result = $conn->query($sql);

  // Initialize the total variable
  $total = 0;

  // Check if there are any products in cart
  if ($result->num_rows > 0) {
    // Create an array to store the order details
    $order_details = array();

    // Loop through the products in cart
    while($row = $result->fetch_assoc()) {
      // Calculate the subtotal for each product
      $subtotal = $row["price"] * $row["quantity"];

      // Add the subtotal to the total
      $total += $subtotal;

      // Add the product details to the order details array
      $order_details[] = array(
        "product_id" => $row["id"],
        "product_name" => $row["name"],
        "product_price" => $row["price"],
        "product_quantity" => $row["quantity"],
        "product_subtotal" => $subtotal
      );

      // Update the product inventory in the database
      $new_stock = $row["quantity"] - $row["quantity"];
      $update_sql = "UPDATE products SET quantity = '$new_stock' WHERE id = '" . $row["id"] . "'";
      $conn->query($update_sql);
    }

    // Insert the order details into the database
    $order_sql = "INSERT INTO orders (customer_name, customer_email,customer_address, phone, total,shipping) VALUES ('$name', '$email', '$address', '$phone', '$total', '$shipping')";
    if ($conn->query($order_sql) === TRUE) {
      // Get the last inserted order id
      $order_id = $conn->insert_id;

      // Loop through the order details array and insert them into the database
      foreach ($order_details as $detail) {
        $detail_sql = "INSERT INTO order_items (order_id, product_name, product_price, quantity, product_id, product_subtotal, date) VALUES ('$order_id', '" . $detail["product_name"] . "', '" . $detail["product_price"] . "', '" . $detail["product_quantity"] . "','" . $detail["product_id"] . "', '" . $detail["product_subtotal"] . "', CURDATE())";
        if ($conn->query($detail_sql) === TRUE) {
          // Do nothing
        } else {
          echo "Error: " . $detail_sql . "<br>" . $conn->error;
        }
      }

      // Display a confirmation message and a link to view the order details
      echo "<p>Your order has been placed successfully. Your order id is " . $order_id . "</p>";
      echo "<p><a href='view_order.php?id=" . $order_id . "'>View your order details</a></p>";

      // Send an email to the customer with the order details
      // To do

    } else {
      echo "Error: " . $order_sql . "<br>" . $conn->error;
    }

    // Clear the cart from the database
    // To do

  } else {
    // Display a message if there are no products in cart
    echo "<p>Your cart is empty.</p>";
  }

  // Close the database connection
  $conn->close();
} else {
  // Display a message if the form is not submitted
  echo "<p>Please fill out the checkout form.</p>";
}
?>