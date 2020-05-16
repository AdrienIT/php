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

$id = $_SESSION["user_id"];

if (isset($_GET['postuler']) and !empty($_GET['postuler'])) {

    $sql2 = 'INSERT INTO detail_offres (user_id) VALUES (:id)'; 

    $insert2 = $db->prepare($sql2);
    $insert2->bindParam(':id', $id);
    $insert2->execute();
}



$postes = $db->query('SELECT * FROM offers ORDER BY date_time_post DESC');

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Postes</title>
</head>

<body>

    <ul>
        <?php while ($p = $postes->fetch()) { ?>
            <li><a href="offers.php?id=<?= $p['offer_id'] ?>"><?= $p['titre'] ?></a> | <a href="postuler.php?id=<?= $p['offer_id']?>">Postuler à l'offre</a>  | <a href="depostuler.php?id=<?= $p['offer_id']?>">De-Postuler</a></li>
        <?php } ?>

        <a href="../user/home.php">HomePage</a>

    </ul>

    <a href="../"></a>

</body>

</html>