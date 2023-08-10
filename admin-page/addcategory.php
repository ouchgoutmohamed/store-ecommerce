<?php

$db = mysqli_connect("localhost", "root", "", "store");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  

  $image = $_FILES['image'];
  $imageName = time() . "-" . basename($image["name"]);
  $targetDir = "img/";
  $targetFile = $targetDir . $imageName;
  move_uploaded_file($image["tmp_name"], $targetFile);

  $sql = "INSERT INTO categories (name, image) VALUES ('$name',  '$imageName')";
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
  <link rel="stylesheet" href="compte.css">
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
    
    

    <label for="product_image">Product Image</label>
    <input type="file" id="image" name="image" required>
    
    <button type="submit" name="submit">Add Product</button>
  </form>
</div>

 
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