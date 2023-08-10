<?php
$db = mysqli_connect("localhost", "root", "", "store");

if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

$id = $_GET['id'];
$sql = "DELETE FROM products WHERE id=$id";

if ($db->query($sql) === TRUE) {
  header("Location: addproduct.php");
  echo "done: ";
} else {
  echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();
?>