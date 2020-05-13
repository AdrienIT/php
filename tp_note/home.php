<?php
include_once 'connect.php';
session_start();
if (!isset($_SESSION["username"])) {
    header('location: index.php');
}
$session_username = $_SESSION['username'];
?>


<html>
<head>
    <title>Home page</title>
</head>
    <body>
    <ul>
        <li> <a href="profile.php">Profile</a></li>
    </ul>
    </body>
</html>