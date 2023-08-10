<?php
include 'config.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

if ($action == 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$address = isset($_POST["address"]) ? $_POST["address"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$role = isset($_POST["role"]) ? $_POST["role"] : "";

    $sql = "INSERT INTO users (name, email, address, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $email, $address, $password, $role);
    $stmt->execute();

    header("Location: comptes_management.php");
    exit();
}

if ($action == 'edit' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id'];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $sql = "UPDATE users SET name = ?, email = ?, address = ?, password = ?, role = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $email, $address, $password, $role, $id);
    $stmt->execute();

    header("Location: comptes_management.php");
    exit();
}

if ($action == 'delete') {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: comptes_management.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Comptes Management</title>
    <link rel="stylesheet" href="cc.css">
    <style>
         body {
    font-family: 'Roboto', sans-serif;
    background-color: #f8f9fa;
}
        .order-table {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #007bff;
}

.containers {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 1.5rem;
}



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
}

form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f2f2f2;
}

form label {
    display: block;
    margin-top: 15px;
}

form input {
    display: block;
    width: 100%;
    padding: 5px;
    margin-top: 5px;
}

    </style>
</head>
<body>
<?php include 'admin.html' ?>
<section class="home-section">
<div class="containers">
    <?php if ($action == 'list') { ?>
        <h1 class="mb-4">Comptes- Mangement</h1>
        <a href="comptes_management.php?action=add" class="button" >Add User</a>
        <div class="order-table">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT id, name, email, address, password, role FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["role"] . "</td>";
                        echo '<td>
                                <a class="button" href="comptes_management.php?action=edit&id=' . $row["id"] . '">Edit</a> |
                                <a class="button" href="comptes_management.php?action=delete&id=' . $row["id"] . '">Delete</a>
                              </td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No users found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    <?php } elseif ($action == 'add') { ?>
        <div class="container">
        <h1>Add User</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?action=add"; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
          
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="role">Role:</label>
            <input type="text" id="role" name="role" required>
            
            <button type="submit" value="Submit">Submit </button>
            <a href="comptes_management.php" class="button">Back</a>
        </form>
        </div>
    <?php } elseif ($action == 'edit') {
        $id = $_GET['id'];
        $sql = "SELECT id, name, email, address, password, role FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        ?>
       <div class="container">
        <h1>Edit User</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?action=edit&id=" . $id; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $user["name"]; ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user["email"]; ?>" required>
        
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $user["address"]; ?>" required>
           
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $user["password"]; ?>" required>
            
            <label for="role">Role:</label>
            <input type="text" id="role" name="role" value="<?php echo $user["role"]; ?>" required>
            
            <button type="submit" value="Submit">Submit</button>
            <a href="comptes_management.php" class="button">Back</a>
        </form>
      </div>
    <?php } ?>
    </div>
    
    </section>
   
</body>
</html>