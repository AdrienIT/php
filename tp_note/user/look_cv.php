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