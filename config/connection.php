<?php
$dbHost = "localhost";
$dbName = "user_auth";
$dbUser = "yourusername";
$dbPass = "password";

try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    $conn = null;
}
?>