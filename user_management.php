<?php
session_start();
require_once 'config.php';

if (isset($_POST["signup"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, address, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $email, $address, $hashed_password, $role);
    $stmt->execute();

    header("Location: login.php");
    exit;
}

if (isset($_POST["login"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

   
    if (password_verify($password, $user['password'])) {
     
        $_SESSION['email'] = $user['email'];
        $_SESSION['user_id'] = $user['id']; 
        
        
        if ($user['role'] === 'admin') {
            header("Location: admin-page/addproduct.php");
            exit;
        } else {
            header("Location: products.php");
            exit;
        }
    } else {
        
        header("Location: login.php?error=invalid");
        exit;
    }
}

