<?php
include_once 'connect.php';
session_start();
if (!isset($_SESSION["user_id"])) {
    header('location: ../index.php');
}


$id = (int) $_SESSION["user_id"];

$query = $db->prepare("SELECT * FROM users WHERE user_id = :id ");
$query->bindParam(":id", $id);
$query->execute();
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