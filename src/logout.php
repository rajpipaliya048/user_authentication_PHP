<?php

session_start();
$_SESSION = array();
session_destroy();
header("Location: ../templates/login_form.php");
exit();
