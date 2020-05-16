<?php
$db = new PDO('mysql:host=localhost; dbname=tp_note;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if (!$db) {
    die("Bad Connection");
}

session_start();
if (!isset($_SESSION["entreprise_id"])) {
    header('location: ./index.php');
}


$query = $db->query('SELECT * FROM detail_offres d INNER JOIN users u ON (u.user_id = d.user_id) INNER JOIN offers o ON (o.offer_id = d.offre_id)' );

$user = $query->fetch();

$username = $user['username'];


if (file_exists("../user/" . $username . "/" . $username . ".pdf")) {
    $cv = "../user/" . $username . "/" . $username . ".pdf";
    $error_cv = "";
} else {
    $cv = '';
    $error_cv = "Cet utilisateur n'a pas posté de CV.";
}



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Candidats</title>
</head>
<body>
    <h1>Listes des candidats</h1>
    <ul>
     <p> L'utilisateur : <strong><?= $username ?></strong>  à postulé pour l'offre <strong><?= $user['titre'] ?></strong> | <a href="<?= $cv ?>">Son CV</a> : <?= $error_cv ?></p>
    </ul>
    <a href="../entreprise/vos_offres.php">Vos offres</a>
</body>
</html>