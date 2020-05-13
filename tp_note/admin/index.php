<?php
$bdd = new PDO('mysql:host=localhost; dbname=tp_note;charset=utf8', 'root', '');

if (isset($_GET['reset_auto_increment']) and !empty($_GET['reset_auto_increment'])) {
    $reset_auto_increment = (int) $_GET['reset_auto_increment'];
    $req = $bdd->prepare('ALTER TABLE users AUTO_INCREMENT = 1');
    $req->execute(array($reset_auto_increment));
    header('Location: index.php');
}



if (isset($_GET['delete']) and !empty($_GET['delete'])) {
    $delete = (int) $_GET['delete'];
    $req = $bdd->prepare('DELETE FROM users WHERE user_id = ?');
    $req->execute(array($delete));
}

$users = $bdd->query('SELECT * FROM users');
$entreprises = $bdd->query('SELECT * FROM entreprises');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Administration</title>
</head>

<body>
    <h1>Page d'administration</h1>
    
    <a href="./users.php">Users</a><br>
    <a href="./entreprises.php">Entreprises</a><br>
    <a href="./increment.php">Incrementation</a><br><br>
    <a href="../index.php">Retour Page principale</a>
</body>

</html>