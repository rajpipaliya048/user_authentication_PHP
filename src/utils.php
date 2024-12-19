<?php

require "../config/connection.php";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// function check_username_exists($username) {
//     try {
//         global $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         $result = $conn -> exec("select COUNT(*) from user where username='$username'");
//         return $result;
//     } catch (PDOException $e) {
//         echo "Error: " . $e->getMessage();
//     }
// }

?>