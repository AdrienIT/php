<?php
$bdd = new PDO('mysql:host=localhost; dbname=tp_note;charset=utf8', 'root', '');

if (isset($_GET['delete']) and !empty($_GET['delete'])) {
    $delete = (int) $_GET['delete'];
    $req = $bdd->prepare('DELETE FROM users WHERE user_id = ?');
    $req->execute(array($delete));
}

$users = $bdd->query('SELECT * FROM users');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Users</title>
</head>

<body>
    <ul>
        <?php while ($u = $users->fetch()) { ?>
            <li><?= $u['user_id'] ?> : <?= $u['username'] ?> - <a href="users.php?delete=<?= $u['user_id'] ?>">Supprimer</a> - <a href="update_user.php?id=<?= $u['user_id'] ?>">Editer le compte</a> </li>
        <?php } ?>
    </ul>
    <a href="index.php">Retour à la page d'administration</a>
</body>

</html>