<?php
	$db = new PDO('mysql:host=localhost; dbname=tp_note;charset=utf8','root','');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (!$db) {
		die("Bad Connection");
	}
?>