<?php

$db = mysqli_connect("localhost", "root", "", "store");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $description = $_POST['description'];
  $category = $_POST['category'];

  $image = $_FILES['image'];
  $imageName = time() . "-" . basename($image["name"]);
  $targetDir = "img/";
  $targetFile = $targetDir . $imageName;
  move_uploaded_file($image["tmp_name"], $targetFile);

  $sql = "INSERT INTO products (name, price, quantity, description, image,category) VALUES ('$name', '$price', '$quantity', '$description', '$imageName', '$category')";
  if ($db->query($sql) === TRUE) {
    echo "New product added successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Management</title>
  <link rel="stylesheet" href="Styles.css">
  <link rel="stylesheet" href="cc.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
  .button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.3s;
}

.button:hover {
    background-color: #0056b3;
    transform: scale(1.05);
    color:white;
}

</style>
</head>
<body>
<?php include 'admin.html' ?>
<section class="home-section">
  
<h1>Add Product</h1>
  <div class="container">
 
  <form action="" method="POST" enctype="multipart/form-data">
    <label for="name">Product Name</label>
    <input type="text" id="name" name="name" required>
    
    <label for="price">Product Price</label>
    <input type="number" id="price" name="price" step="0.01" required>
    
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" required>

    <label for="description">Product Description</label>
    <textarea id="description" name="description" required></textarea>

    <label for="description">Product category</label>
    <select name="category" class="box" >
     <option value="Phone">Phone</option>
     <option value="Laptop">Laptop</option>
     <option value="Smart Watch">Smart Watch</option>
     <option value="Chargeur">Chargeur</option>
     <option value="ecouteurs">ecouteurs</option>
   </select>

    <label for="product_image">Product Image</label>
    <input type="file" id="image" name="image" required>
    
    <button type="submit" name="submit">Add Product</button>
  </form>
</div>

  <h1>Products</h1>
  <table>
    <tr>
      <th>Name</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Description</th>
      <th>category</th>
      <th>Image</th>
      <th>Actions</th>
    </tr>
    <?php
    $sql = "SELECT * FROM products";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["category"] . "</td>";
        echo "<td><img src='img/" . $row["image"] . "' alt='product image' width='50'></td>" ;
        echo "<td><a class='button' href='edit.php?id=" . $row["id"] . "'>Edit</a> | <a class='button' href='delete.php?id=" . $row["id"] . "'>Delete</a></td>";
        echo "</tr>";
       
      }
    } else {
      echo "<tr><td colspan='6'>No products found</td></tr>";
    }
    $db->close();
    ?>
  </table>
  </section>
  <script >
    $("input, textarea").focus(function () {
  $(this).css("background-color", "#f2f2f2");
}).blur(function () {
  $(this).css("background-color", "#fff");
});

$("tr").hover(
  function () {
    $(this).css("background-color", "#ddd");
  },
  function () {
    $(this).css("background-color", "");
  }
);
  </script>
 
</body>
</html>