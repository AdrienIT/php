<?php
include_once 'connect.php';
session_start();
if (!isset($_SESSION["username"])) {
    header('location: ../index.php');
}
$session_username = $_SESSION['username'];

$query = $db->prepare("SELECT * FROM users WHERE username = ? ");
$query->execute([$session_username]);
$user = $query->fetch();

$username = $user["username"];

?>

<?php
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