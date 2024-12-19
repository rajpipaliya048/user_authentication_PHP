<?php

if (isset($_SESSION['user'])) {
    header("Location: ../templates/profile.php");
}
session_start();
$errors = $_SESSION["errors"] ?? [];
session_unset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333333;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555555;
        }
        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #dddddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }
        .login-btn {
            display: block;
            width: 100%;
            padding: 0.75rem;
            background: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-btn:hover {
            background-color: #0056b3;
        }
        .login-container .forgot-password {
            text-align: center;
            margin-top: 1rem;
        }
        .login-container .forgot-password a {
            color: #007bff;
            text-decoration: none;
        }
        .login-container .forgot-password a:hover {
            text-decoration: underline;
        }
        .error {
            color: #FF0000;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="../src/login.php" method="POST">
            <div class="form-group">
                <label for="username">username</label>
                <input type="username" id="username" name="username" placeholder="Enter your username" required>
                <span class="error"><?php echo $errors['usernameErr'] ?? ''; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <span class="error"><?php echo $errors['passwordErr'] ?? ''; ?></span>
            </div>
            <button type="submit" class="login-btn">Login</button>
            <div class="forgot-password">
                <a href="/forgot-password">Forgot Password?</a>
            </div>
        </form>
    </div>
</body>
</html>
