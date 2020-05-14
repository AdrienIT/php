<?php 
session_start();
session_unset($_SESSION["entreprise_id"]);
session_destroy();

header('location: index.php');
?>