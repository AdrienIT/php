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


if ($confirme == 0) {
    $check_valide = "Votre compte n'est pas encore validé, vous ne pouvez pas postuler des offres";
} else {
    $check_valide = "Votre compte est confirmé, vous pouvez postulez des offres";
}

?>


<html>
<head>
    <title>Home page</title>
    <meta charset="utf-8">
</head>
    <body>
    <ul>
        <li> <a href="profile.php">Profile</a></li>
        <li><a href="redaction.php">Rédiger un article</a></li>
        <li><a href="vos_offres.php">Vos offres</a></li>
    </ul>

    <?php echo $check_valide ?>

    </body>
</html>