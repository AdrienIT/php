<?php 
	session_start();
	include_once 'connect.php';

	$id = (int) $_SESSION["entreprise_id"];

	$query = $db->prepare("DELETE FROM entreprises WHERE entreprise_id = :id");
	$query->bindParam(":id", $id);
	if ($query->execute()) {
		session_unset($_SESSION["entreprise_id"]);
        session_destroy();
		header('location: index.php');
	}
?>