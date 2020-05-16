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

$user_id = (int) $_SESSION["user_id"];
 
$get_id = (int) $_GET['id'];

var_dump($user_id, $get_id);
 

$query = $db->prepare('SELECT * FROM detail_offres WHERE user_id = :user_id AND offre_id = :offre_id');
$query->bindParam(':user_id', $user_id);
$query->bindParam(':offre_id', $get_id);
$query->execute();
$sql_verif = $query->fetch();

var_dump($sql_verif);

if (!empty($sql_verif)) {
    header('Location: postes.php');
} else {
    $sql = 'INSERT INTO detail_offres(offre_id, user_id)  VALUE (:offre_id, :user_id)';

    $insert = $db->prepare($sql);
    $insert->bindParam(':offre_id', $get_id);
    $insert->bindParam(':user_id', $user_id);
    $insert->execute();
    
    header('Location: postes.php');
}




?>
