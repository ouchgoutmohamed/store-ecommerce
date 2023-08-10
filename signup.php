<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="admin-page/cc.css">
</head>
<body>
    
        <h1>Sign Up</h1>
        <form action="user_management.php" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <input type="hidden" name="role" value="client">
            <input type="submit" name="signup" value="Sign Up">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
        
    
</body>
</html>