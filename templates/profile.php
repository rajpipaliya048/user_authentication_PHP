<?php

require "../config/connection.php";

session_start();
if (isset($_SESSION['user'])) {
    $user_id = (int) ($_SESSION['user']);
} else {
    header("Location: ../templates/login_form.php");
    exit();
}

$username = $fullname = $email = $age = $gender = $hobby = $profile_pic = "";

$user_data = $conn->query("select username, firstname, lastname, email from user where id=$user_id");
$profile_data = $conn->query("select * from user_profile where user_id=$user_id");

while($row = $user_data->fetch(PDO::FETCH_ASSOC)){
    $username = $row['username'];
    $fullname = $row['firstname'] . " " . $row['lastname'];
    $email = $row['email'];
}

while($row = $profile_data->fetch(PDO::FETCH_ASSOC)){
    $age = $row['age'];
    $gender = $row['gender'];
    $hobby = $row['hobby'];
    $profile_pic = $row['profile_pic'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        .profile-container {
  width: 50%;
  margin: 0 auto;
  font-family: 'Roboto', sans-serif;
}

.profile-header {
  text-align: center;
  margin-bottom: 20px;
}

.profile-pic {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #ccc;
}

.username {
  font-size: 24px;
  font-weight: bold;
  margin-top: 10px;
}

.profile-details {
  background: #f9f9f9;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.detail-row {
  display: flex;
  justify-content: space-between;
  margin: 10px 0;
}

label {
  font-weight: bold;
}

span {
  color: #555;
}

.action-buttons {
  text-align: center;
  margin-top: 20px;
}

.btn {
  padding: 10px 20px;
  margin: 5px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
.btn a {
    text-decoration: none;
}

.save-btn {
  background-color: #4caf50;
  color: white;
}

.cancel-btn {
  background-color: white;
  color: #555;
  border: 1px solid #ccc;
}
    </style>
</head>
<body>
<div class="profile-container">
  <div class="profile-header">
    <img src="<?php echo "http://localhost:9001/$profile_pic"  ?? ''; ?>" alt="Profile" class="profile-pic" />
    <h1 class="username"><?php echo $username ?? ''; ?></h1>
  </div>
  <div class="profile-details">
    <div class="detail-row">
      <label>Full Name:</label>
      <span><?php echo $fullname ?? ''; ?></span>
    </div>
    <div class="detail-row">
      <label>Email:</label>
      <span><?php echo $email ?? ''; ?></span>
    </div>
    <div class="detail-row">
      <label>Age:</label>
      <span><?php echo $age ?? ''; ?></span>
      <label>Gender:</label>
      <span><?php echo $gender ?? ''; ?></span>
    </div>
    <div class="detail-row">
      <label>Hobby:</label>
      <span><?php echo $hobby ?? ''; ?></span>
    </div>
  </div>
  <div class="action-buttons">
    <button class="btn logout-btn"><a href="../src/logout.php">Logout</a></button>
  </div>
</div>

</body>
</html>