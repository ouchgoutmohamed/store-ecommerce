<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
   
  <style>
    .col-12 {
      margin-top:30px;
      display: inline-block;
    }
    .new-products-title {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
        }
        .new-products {
            margin-top: 40px;
            margin-bottom: 40px;
            
        }

        /* New products cards */
        .new-products-card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
        }

        /* New products card hover effect */
        .new-products-card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        /* New products card image */
        .new-products-card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* New products card body */
        .new-products-card-body {
            padding: 16px;
        }

        /* New products card title */
        .new-products-card-title {
            font-size: 24px;
            font-weight: bold;
        }
  </style>
</head>
<body>
<?php include 'header.html' ?>
<?php
// Connect to the database using your credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "store";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$query = $_GET["query"];

$query = $conn->real_escape_string($query);


$results = array();

$sql = "SELECT * FROM products WHERE name LIKE '%$query%'";
$result = $conn->query($sql);

// If there are any results, add them to the array
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $results[] = array(
      
      "id" => $row["id"],
      "name" => $row["name"],
      "description" => $row["description"],
      "price" => $row["price"],
      "image" => $row["image"]
    );
  }
}

// Close the database connection
$conn->close();

// Display the results in a HTML table



foreach ($results as $result) {
  echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3">';
echo '<div class="card new-products-card">';
echo '<img src="admin-page/img/'  . $result["image"] . '" alt="' . $result["name"]. '" class="card-img-top new-products-card-image">';

echo '<div class="card-body new-products-card-body">';
echo '<h5 class="card-title new-products-card-title">' . $result["name"] . '</h5>';
echo '<p class="card-text new-products-card-price">$' . $result["price"] . '</p>';
echo '<a href="#" class="btn btn-primary">Add to Cart</a>';
echo '</div>';
echo '</div>';
echo '</div>';
}


?>
<?php include 'footer.php' ?>
</body>
</html>