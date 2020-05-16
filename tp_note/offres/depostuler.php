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

$sql = 'DELETE FROM detail_offres WHERE offre_id = :offre_id';

$insert = $db->prepare($sql);
$insert->bindParam(':offre_id', $get_id);
$insert->execute();
    
header('Location: postes.php');

?>
