<?php
include_once 'connect.php';

session_start();

if (!isset($_SESSION["entreprise_id"])) {
    header('location: ./index.php');
}

$id = (int) $_SESSION["entreprise_id"];

$query = $db->prepare("SELECT * FROM entreprises WHERE entreprise_id = :id ");
$query->bindParam(":id", $id);
$query->execute();
$user = $query->fetch();

$confirme = $user["confirme"];

$edition = 0;

if ($confirme == 0) {
    header('location: ./home.php');
}

if (isset($_GET['edit']) and !empty($_GET['edit'])) {
    $edition = 1;
    $edit_id = htmlspecialchars($_GET['edit']);
    $edit_contenu = $db->prepare('SELECT * FROM offers WHERE offer_id = ?');
    $edit_contenu->execute(array($edit_id));

    if ($edit_contenu->rowCount() == 1) {
        $edit_contenu = $edit_contenu->fetch();
    } else {
        die("L'article n'existe pas !");
    }
}


if (isset($_POST['titre'], $_POST['contenu'])) {
    if (!empty($_POST['titre']) and !empty($_POST['contenu'])) {

        $titre = htmlspecialchars($_POST['titre']);
        $contenu = htmlspecialchars($_POST['contenu']);

        if ($edition == 0) {

            $sql1 = 'INSERT INTO offers (titre, contenu, date_time_post, entreprise_id) VALUES (:titre, :contenu, NOW(), :id)';

            $insert = $db->prepare($sql1);
            $insert->bindParam(":titre", $titre);
            $insert->bindParam(":contenu", $contenu);
            $insert->bindParam(':id', $id);
            $insert->execute();


            $message = "Offres postée avec succés !";
        } else {
            $update = $db->prepare('UPDATE offers SET titre = ?, contenu = ? WHERE offer_id = ?');
            $update->execute(array($titre, $contenu, $edit_id));
            header ('Location: redaction.php');
            $message = "Offres mise à jour avec succés";
            echo $message;
        }
    } else { 
    $message = "Merci de remplir les 2 champs";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page de rédaction et d'édition</title>
</head>

<body>
    <form method="POST">
        <input type="text" name="titre" placeholder="Titre de l'offre"> <br>
        <textarea placeholder="Contenu de l'offre" name="contenu"></textarea> <br>
        <input type="submit" value="Envoyer l'offre"> <br>
    </form>


    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>


    <a href="home.php">HomePage</a>


</body>

</html>