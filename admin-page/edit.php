<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $description = $_POST['description'];
  $image = $_POST['image'];

  $sql = "UPDATE products SET name='$name', price='$price', quantity='$quantity', description='$description', image='$image' WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
} else {
  die("Product not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Product</title>
  <link rel="stylesheet" href="Styles.css">
</head>
<body>
  <div class="container">
  <h1>Edit Product</h1>
  <label for="name">Product Name</label>
    <input type="text" id="name" name="name" required>
    
    <label for="price">Product Price</label>
    <input type="number" id="price" name="price" step="0.01" required>
    
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" required>

    <label for="description">Product Description</label>
    <textarea id="description" name="description" required></textarea>
    
    <select name="categories" class="box" >
     <option value="Marbre">Marbre</option>
     <option value="Zellige">Zellige</option>
     <option value="Peinture">Peinture murale</option>
     <option value="Electricity">Electricity</option>
     <option value="Materiaux,gros oeuvre">Matériaux,gros oeuvre</option>
   </select>

    <label for="product_image">Product Image</label>
    <input type="file" id="image" name="image" required>
     <button type="submit" >Edit Product</button>
  </form>
  </div>
</body>
</html>