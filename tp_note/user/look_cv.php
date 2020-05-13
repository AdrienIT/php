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
echo "<!doctype html>
    <html lang=fr>
    <head>
      <meta charset=utf-8>
      <title>Titre de la page</title>
    </head>
    <body>
    <a href=cv.php>Retour</a>
      <embed src=" . "./" . $username . "/" . $username . ".pdf" . " width=800 height=1000 type='application/pdf' />
    </body>
    </html>
    ";
?>