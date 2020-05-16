<?php 
	session_start();
	include_once 'connect.php';

	$id = (int) $_SESSION["entreprise_id"];

	$db = new PDO('mysql:host=localhost; dbname=tp_note;charset=utf8','root','');

	$query = $db->prepare("DELETE FROM entreprises WHERE entreprise_id = :id");
	$query->bindParam(":id", $id);
	if ($query->execute()) {
		session_unset($_SESSION["entreprise_id"]);
        session_destroy();
		header('location: index.php');
	}
?>