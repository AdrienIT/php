<?php
include_once 'connect.php';
session_start();
if (!isset($_SESSION["user_id"])) {
    header('location: ./index.php');
}
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