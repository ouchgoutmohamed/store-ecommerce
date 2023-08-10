<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="admin-page/cc.css">
</head>
<body>
    
        <h1>Login</h1>
        <form action="user_management.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" name="login" value="Login">
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </form>
      
    
</body>
</html>