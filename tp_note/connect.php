<?php
	$db = new PDO("mysql:host=localhost; dbname=tp_note",'root','');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (!$db) {
		die("Bad Connection");
	}
?>