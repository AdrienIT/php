<?php
include_once 'connect.php';
session_start();
if (!isset($_SESSION["username"])) {
    header('location: index.php');
}
$session_username = $_SESSION['username'];

$query = $db->prepare("SELECT * FROM users WHERE username = ? ");
$query->execute([$session_username]);
$user = $query->fetch();

$username = $user["username"];

?>

<form action='upload.php' method='POST' enctype='multipart/form-data'>
    <p>Envoie ton CV en .pdf</p>
    <input type='file' name='file' id='file'>
    <input type='submit' name='submit' value='Upload'>
</form>
<br>
<a href="look_cv.php">Regarde ton CV</a><br>
<a href="delete_cv.php">Supprime ton CV</a>
<br>
<br>
<a href="profile.php">Retour</a>