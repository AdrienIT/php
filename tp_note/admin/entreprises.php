<?php
$bdd = new PDO('mysql:host=localhost; dbname=tp_note;charset=utf8', 'root', '');

if (isset($_GET['delete']) and !empty($_GET['delete'])) {
    $delete = (int) $_GET['delete'];
    $req = $bdd->prepare('DELETE FROM entreprises WHERE entreprise_id = ?');
    $req->execute(array($delete));
    header('Location: entreprises.php');
}

$entreprises = $bdd->query('SELECT * FROM entreprises');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Entreprise</title>
</head>

<body>
    <ul>
        <?php while ($e = $entreprises->fetch()) { ?>
            <li><?= $e['entreprise_id'] ?> : <?= $e['username'] ?> - <a href="entreprises.php?delete=<?= $e['entreprise_id'] ?>">Supprimer</a></li>
        <?php } ?>
    </ul>
    <a href="index.php">Retour à la page d'administration</a>
</body>

</html>