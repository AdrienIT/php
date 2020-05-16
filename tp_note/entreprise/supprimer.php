<?php
include_once 'connect.php';
session_start();
if (!isset($_SESSION["entreprise_id"])) {
    header('location: ./index.php');
}

if (isset($_GET['id']) AND !empty($_GET['id'])) {
    $supp_id = htmlspecialchars($_GET['id']);

    $insert = $db->prepare('DELETE FROM detail_offres WHERE offre_id = :offre_id');
    $insert->bindParam(':offre_id', $supp_id);
    $insert->execute();

    $supp = $db->prepare('DELETE FROM offers WHERE offer_id = ?');
    $supp->execute(array($supp_id));
    
    header('Location: vos_offres.php');

}
