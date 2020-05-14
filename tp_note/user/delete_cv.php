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

if (is_dir($username)) {
    array_map('unlink', glob("$username/*.*"));
    rmdir("./" . $username . "/");
    echo "File removed with sucess<br>";
    echo "<a href=cv.php>Retour</a>";
} else {
    echo "Pas de CV pour le moment<br>"; 
    echo "<a href=cv.php>Retour</a>";
}
?>