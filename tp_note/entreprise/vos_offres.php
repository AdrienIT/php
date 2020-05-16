<?php
include_once 'connect.php';
session_start();
if (!isset($_SESSION["entreprise_id"])) {
    header('location: ./index.php');
}

$id = (int) $_SESSION["entreprise_id"];

$sql = '
SELECT * FROM offers WHERE entreprise_id = :id
';

$offres = $db->prepare($sql);
$offres->bindParam(':id', $id);
$offres->execute();


$query = $db->prepare("SELECT * FROM entreprises WHERE entreprise_id = :id ");
$query->bindParam(":id", $id);
$query->execute();
$user = $query->fetch();

$confirme = $user["confirme"];

if ($confirme == 0) {
    header('location: ./home.php');
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Accueil</title>
    <meta charset="utf-8">
</head>

<body>
    <ul>
        <?php while ($p = $offres->fetch()) { ?>
            <li><a href="../offres/offers.php?id=<?= $p['offer_id'] ?>"><?= $p['titre'] ?></a> - <a href="redaction.php?edit=<?= $p['offer_id'] ?>">Modifier</a> - <a href="supprimer.php?id=<?= $p['offer_id'] ?>">Supprimer</a> - <a href="../offres/detail_offres.php?id=<?= $p['offer_id'] ?>">Voir vos offres</a></li>
        <?php } ?>
        <ul>
            <br><br>
    <a href="home.php">Retour Home</a>
</body>

</html>