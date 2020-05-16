<?php

$db = new PDO('mysql:host=localhost; dbname=tp_note;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!$db) {
    die("Bad Connection");
}

session_start();
if (!isset($_SESSION["user_id"])) {
    header('location: ./index.php');
}



if (isset($_GET['id']) and !empty($_GET['id'])) {
    $get_id = htmlspecialchars($_GET['id']);

    $postes = $db->prepare('SELECT * FROM offers WHERE offer_id = ?');
    $postes->execute(array($get_id));

    if ($postes->rowCount() == 1) {
        $postes = $postes->fetch();
        $titre = $postes['titre'];
        $contenu = $postes['contenu'];
    } else {
        die("Cette offre n'existe pas");
    }
} else {
    die('Cet article n\'existe pas !');
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Postes</title>
</head>

<body>

    <h1><?= $titre ?></h1>
    <p><?= $contenu ?></p>

</body>

</html>