<?php
$bdd = new PDO('mysql:host=localhost; dbname=tp_note;charset=utf8', 'root', '');

if (isset($_GET['confirme']) and !empty($_GET['confirme'])) {
    $confirme = (int) $_GET['confirme'];
    $req = $bdd->prepare('UPDATE entreprises SET confirme = 1 WHERE entreprise_id = ?');
    $req->execute(array($confirme));
    header('Location: entreprises.php');
}

if (isset($_GET['deconfirme']) and !empty($_GET['deconfirme'])) {
    $deconfirme = (int) $_GET['deconfirme'];
    $req = $bdd->prepare('UPDATE entreprises SET confirme = 0 WHERE entreprise_id = ?');
    $req->execute(array($deconfirme));
    header('Location: entreprises.php');
}

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
        <li><?= $e['entreprise_id'] ?> : <?= $e['username'] ?><?php if ($e['confirme'] == 0 ) { ?> - <a href="entreprises.php?confirme=<?= $e['entreprise_id'] ?>">Confirmer le Compte</a><?php } ?> - <a href="entreprises.php?deconfirme=<?= $e['entreprise_id'] ?>">Deconfirmer le Compte</a> - <a href="entreprises.php?delete=<?= $e['entreprise_id'] ?>">Supprimer</a>  - <a href="update_entreprise.php?id=<?= $e['entreprise_id'] ?>">Editer le compte</a> </li>
        <?php } ?>
    </ul>

    <a href="index.php">Retour à la page d'administration</a>
</body>

</html>