<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/coresystem/init.php';
	$db->query("Delete FROM `users` WHERE edate <= join_date AND permissions = 'user'");
?>