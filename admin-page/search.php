<?php
// Connect to the database
$db = new mysqli("localhost", "root", "", "store");

// Check for connection errors
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

// Get the query from the input
$query = $_GET["query"];

// Sanitize the query to prevent SQL injection
$query = $db->real_escape_string($query);

// Create an empty array to store the results
$results = array();

// Query the products table
$sql = "SELECT * FROM products WHERE name LIKE '%$query%' OR description LIKE '%$query%'";
$result = $db->query($sql);

// Check for query errors
if ($result === false) {
  die("Query error: " . $db->error);
}

// Loop through the products and add them to the results array
while ($row = $result->fetch_assoc()) {
  $results[] = array(
    "type" => "product",
    "id" => $row["id"],
    "name" => $row["name"],
    "image" => $row["image"],
    "quantity" => $row["quantity"],
    "description" => $row["description"],
    "price" => $row["price"],
    "category" => $row["name"],
  );
}

// Free the result set
$result->free();

// Query the users table
$sql = "SELECT * FROM users WHERE name LIKE '%$query%' OR email LIKE '%$query%'";
$result = $db->query($sql);

// Check for query errors
if ($result === false) {
  die("Query error: " . $db->error);
}

// Loop through the users and add them to the results array
while ($row = $result->fetch_assoc()) {
  $results[] = array(
    "type" => "user",
    "id" => $row["id"],
    "name" => $row["name"],
    
    "email" => $row["email"],
    "role" => $row["role"]
  );
}

// Free the result set
$result->free();

// Close the database connection
$db->close();

// Display the results in HTML
?>

<html>
<head>
  <style>
    /* Add some style to the table */
    table {
      border-collapse: collapse;
      width: 80%;
      margin: auto;
    }

    th, td {
      border: 1px solid black;
      padding: 10px;
      text-align: left;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    th {
      background-color:  #f2f2f2;
      color: black;
    }
  </style>
</head>
<body>
<?php include 'admin.html' ?>
<section class="home-section">
  <h1>Search Results</h1>
  <?php
  // Check if there are any results
  if (count($results) > 0) {
    // Display the results in a table with headers based on the type of the first result
    echo "<table>";
    // Get the type of the first result (product or user)
    $type = $results[0]["type"];
    // Display different headers based on the type
    if ($type == "product") {
      // Display headers for product name, description and price
      echo "<tr>";
      echo "<th>Name</th>";
      
      echo "<th>Quantity</th>";
      echo "<th>Description</th>";
      echo "<th>Category</th>";
      echo "<th>image</th>";
      echo "<th>Price</th>";
      echo "<th>Actions</th>";
      echo "</tr>";
    } else if ($type == "user") {
      // Display headers for name, email and role
      echo "<tr>";
      echo "<th>name</th>";
      echo "<th>Email</th>";
      echo "<th>Role</th>";
      echo "<th>actions</th>";
      echo "</tr>";
    }
    
    // Loop through the results and display them in rows
    foreach ($results as $result) {
      // Display different information based on the type
      if ($type == "product") {
        // Display the product name, description and price in columns
        echo "<tr>";
        echo "<td>" . $result["name"] . "</td>";
        echo "<td>" . $result["quantity"] . "</td>";
        echo "<td>" . $result["description"] . "</td>";
        echo "<td>" . $result["category"] . "</td>";
        echo "<td><img src='img/" . $result["image"] . "' alt='product image' width='50'></td>" ;
        echo "<td>$" . $result["price"] . "</td>";
        echo "<td><a class='button' href='edit.php?id=" . $result["id"] . "'>Edit</a> | <a class='button' href='delete.php?id=" . $result["id"] . "'>Delete</a></td>";
        echo "</tr>";
      } else if ($type == "user") {
        // Display the name, email and role in columns
        echo "<tr>";
        echo "<td>" . $result["name"] . "</td>";
        echo "<td>" . $result["email"] . "</td>";
        echo "<td>" . $result["role"] . "</td>";
        echo '<td>
        <a class="button" href="comptes_management.php?action=edit&id=' . $result["id"] . '">Edit</a> |
        <a class="button" href="comptes_management.php?action=delete&id=' . $result["id"] . '">Delete</a>
      </td>';
        echo "</tr>";
      }
      
    }
    
    // Close the table
    echo "</table>";
    
  } else {
    // No results found, display a message
    echo "<p>No results found for '$query'</p>";
  }
  ?>
  </section>
</body>
</html>
