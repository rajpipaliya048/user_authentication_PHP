<?php

require "../config/connection.php";
require "../src/utils.php";

$username = $password = $usernameErr = $passwordErr = $check_pass =  "";

session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../templates/profile.php");
    exit();
}
$errors = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
        $errors = true;
    } else {
        $username = test_input($_POST["username"]);
        $result = $conn->query("select password from user where username='$username'");
        $check_pass = $result->fetchColumn();
        if ($check_pass == '') {
            $usernameErr = "Invalid username.";
            $errors = true;
        } else {
            $username = test_input($_POST["username"]);
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "password is required";
        $errors = true;
    } else {
        $password = test_input($_POST["password"]);
        if ($check_pass != $password) {
            $passwordErr = "Invalid Password";
            $errors = true;
        } else {
            $result = $conn->query("select id from user where username='$username'");
            $user_id = $result->fetchColumn();
            $_SESSION['user'] = $user_id;
            header("Location: ../templates/profile.php");
            exit();
        }
    }

    if ($errors) {
        // Store errors and old input in session
        $_SESSION["errors"] = [
            "usernameErr" => $usernameErr,
            "passwordErr" => $passwordErr,
        ];
        header("Location: ../templates/login_form.php");
        exit();
    }
}
