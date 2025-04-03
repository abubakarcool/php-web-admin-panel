<?php
    $db = mysqli_connect("localhost","aussiedu_aussiedu_username","dutvaussie123.","aussiedu_u434392900_maxdb");
    if(mysqli_connect_errno()){
    echo'database connetion fail bro error chk kr ly ab:'.mysqli_connect_error();
    die();
    }
	$db->query("Delete FROM `users` WHERE edate < NOW() AND permissions = 'user'");
	echo('oh yeah');
?>