<?php
if (isset($_SESSION['user'])) {
    header("Location: ../templates/profile.php");
}
session_start();
$errors = $_SESSION["errors"] ?? [];
$old = $_SESSION["old"] ?? [];
session_unset();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background: #ffffff;
            padding: 60px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        .register-container h1 {
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
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="number"],
        .form-group input[type="file"] {
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
        .form-group input[type="radio"],
        .form-group input[type="checkbox"] {
            margin-right: 0.5rem;
        }
        .form-group label.inline-label {
            display: inline-block;
            margin-right: 1rem;
            font-weight: normal;
        }
        .register-btn {
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
            margin-top: 10px;
        }
        .register-btn:hover {
            background-color: #0056b3;
        }
        .login-link {
            text-align: center;
            margin-top: 1rem;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .error {
            color: #FF0000;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Register</h1>
        <form action="../src/register.php" method="POST" enctype="multipart/form-data">
            <!-- Username -->
            <div class="form-group">
                <label for="username">Username*</label>
                <input type="text" id="username" name="username" placeholder="Enter your username"  value="<?php echo htmlspecialchars($old['username'] ?? ''); ?>">
                <span class="error"><?php echo $errors['usernameErr'] ?? ''; ?></span>
            </div>
            <!-- First Name -->
            <div class="form-group">
                <label for="firstname">First Name*</label>
                <input type="text" id="firstname" name="firstname" placeholder="Enter your first name" >
                <span class="error"><?php echo $errors['firstnameErr'] ?? '';?></span>
            </div>
            <!-- Last Name -->
            <div class="form-group">
                <label for="lastname">Last Name*</label>
                <input type="text" id="lastname" name="lastname" placeholder="Enter your last name" >
                <span class="error"><?php echo $errors['lastnameErr'] ?? '';?></span>
            </div>
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" >
                <span class="error"><?php echo $errors['emailErr'] ?? '';?></span>
            </div>
            <!-- Password -->
            <div class="form-group">
                <label for="password">Password*</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" >
                <span class="error"><?php echo $errors['passwordErr'] ?? '';?></span>
            </div>
            <!-- Confirm Password -->
            <div class="form-group">
                <label for="confirm_password">Confirm Password*</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" >
                <span class="error"><?php echo $errors['confirm_passwordErr'] ?? '';?></span>
            </div>
            <!-- Age -->
            <div class="form-group">
                <label for="age">Age*</label>
                <input type="number" id="age" name="age" placeholder="Enter your age" >
                <span class="error"><?php echo $errors['ageErr'] ?? '';?></span>
            </div>
            <!-- Gender -->
            <div class="form-group">
                <label>Gender*</label>
                <label class="inline-label"><input type="radio" name="gender" value="male" > Male</label>
                <label class="inline-label"><input type="radio" name="gender" value="female" > Female</label>
                <label class="inline-label"><input type="radio" name="gender" value="other" > Other</label>
                <span class="error"><?php echo $errors['genderErr'] ?? '';?></span>
            </div>
            <!-- Hobby -->
            <div class="form-group">
                <label>Hobby</label>
                <input type="text" id="hobby" name="hobby" placeholder="Enter your Hobbies" >
            </div>
            <!-- Profile Picture -->
            <div class="form*-group">
                <label for="profile_pic">Profile Picture</label>
                <input type="file" id="profile_pic" name="profile_pic" accept="image/">
                <span class="error"><?php echo $errors['profile_picErr'] ?? '';?></span>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="register-btn">Register</button>
            <!-- Login Link -->
            <div class="login-link">
                Already have an account? <a href="../templates/login_form.php">Login</a>
            </div>
        </form>
    </div>
</body>
</html>
