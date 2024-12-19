<?php

require "../config/connection.php";
require "../src/utils.php";

$username = $firstname = $lastname = $email = $password = $confirm_password = $age = $gender = $hobby = $profile_pic = "";
$usernameErr = $firstnameErr = $lastnameErr = $emailErr = $passwordErr = $confirm_passwordErr = $ageErr = $genderErr = $profile_picErr = "";

$isActive = 1;

$target_dir = "/home/raj/user_authentication/assets/";
$relative_path = "assets/";
$target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

session_start();
$errors = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
        $errors = true;
    } else {
        $username = test_input($_POST["username"]);
        $result = $conn->query("select COUNT(*) from user where username='$username'");
        if ((int) $result->fetchColumn() != 0) {
            $usernameErr = "Username is already taken, please try with different usernmae.";
            $errors = true;
        } else {
            $username = test_input($_POST["username"]);
        }
    }

    if (empty($_POST["firstname"]) && !preg_match('/^[A-Za-z]+$/', $_POST["firstname"])) {
        $firstnameErr = "firstname is required";
        $errors = true;
    } else {
        $firstname = test_input($_POST["firstname"]);
    }

    if (empty($_POST["lastname"])) {
        $lastnameErr = "lastname is required";
        $errors = true;
    } else {
        $lastname = test_input($_POST["lastname"]);
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Please enter valid email";
        $errors = true;
    } else {
        $email = test_input($_POST["email"]);
        $result = $conn->query("select COUNT(*) from user where email='$email'");
        if ((int) $result->fetchColumn() != 0) {
            $emailErr = "email is already taken, please try with different email.";
            $errors = true;
        } else {
            $email = test_input($_POST["email"]);
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "password is required";
        $errors = true;
    } else {
        $password = test_input($_POST["password"]);
    }

    if (empty($_POST["age"])) {
        $ageErr = "age is required";
        $errors = true;
    } else {
        $age = test_input($_POST["age"]);
    }

    if (empty($_POST["gender"])) {
        $genderErr = "gender is required";
        $errors = true;
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if (!empty($_POST["confirm_password"]) && ($_POST["confirm_password"] != $_POST["password"])) {
        $confirm_passwordErr = "confirm password should same as password";
        $errors = true;
    } else {
        $confirm_password = test_input($_POST["confirm_password"]);
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if (!empty($_POST["gender"])) {
        $hobby = test_input($_POST["hobby"]);
    }
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $profile_picErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $errors = true;
    } else {
        
    }
    $errors = false;
    if ($errors) {
        // Store errors and old input in session
        $_SESSION["errors"] = [
            "usernameErr" => $usernameErr,
            "firstnameErr" => $firstnameErr,
            "emailErr" => $emailErr,
            "lastnameErr" => $lastnameErr,
            "passwordErr" => $passwordErr,
            "confirm_passwordErr" => $confirm_passwordErr,
            "ageErr" => $ageErr,
            "genderErr" => $genderErr,
            "profile_picErr" => $profile_picErr
        ];
        $_SESSION["old"] = [
            "username" => $_POST["username"],
            "firstname" => $_POST["firstname"],
            "email" => $_POST["email"],
            "lastname" => $_POST["lastname"],
            "password" => $_POST["password"],
            "confirm_password" => $_POST["confirm_password"],
            "age" => $_POST["age"],
            "gender" => $_POST["gender"]
        ];
        header("Location: ../templates/register_form.php");
        exit();
    }

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $register_query = "INSERT INTO user (username, firstname, lastname, email, password, is_active)
            VALUES ('$username', '$firstname', '$lastname', '$email', '$password', $isActive)";
        $conn->exec($register_query);

        $get_user_id_query = "select id from user where username='$username'";
        $result = $conn->query($get_user_id_query);
        $user_id = (int) $result->fetchColumn();

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            $profile_pic = $relative_path . basename($_FILES["profile_pic"]["name"]);;
        }
        $profile_query = "INSERT INTO user_profile (user_id, age, gender, hobby, profile_pic)
            VALUES ($user_id, $age, '$gender', '$hobby', '$profile_pic')";
        $conn->exec($profile_query);
        echo "<h1>Successfully registered</h1>";
        $_SESSION['user'] = $user_id;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_SESSION['user'])) {
    header("Location: ../templates/profile.php");
} else {
    header("Location: ../templates/login_form.php");
}
